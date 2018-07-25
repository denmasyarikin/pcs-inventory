<?php

namespace Denmasyarikin\Inventory\Good\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Denmasyarikin\Inventory\Good\Good;
use Denmasyarikin\Inventory\Good\Requests\CreateGoodRequest;
use Denmasyarikin\Inventory\Good\Requests\DetailGoodRequest;
use Denmasyarikin\Inventory\Good\Requests\UpdateGoodRequest;
use Denmasyarikin\Inventory\Good\Requests\DeleteGoodRequest;
use Denmasyarikin\Inventory\Good\Requests\UpdateSortingGoodRequest;
use Denmasyarikin\Inventory\Good\Transformers\GoodListTransformer;
use Denmasyarikin\Inventory\Good\Transformers\GoodDetailTransformer;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class GoodController extends Controller
{
    /**
     * bank list.
     *
     * @param Request $request
     *
     * @return json
     */
    public function getList(Request $request)
    {
        $goods = $this->getGoodList($request, $request->get('status'));

        $transform = new GoodListTransformer($goods);

        return new JsonResponse(['data' => $transform->toArray()]);
    }

    /**
     * get bank list.
     *
     * @param Request $request
     * @param string  $status
     *
     * @return paginator
     */
    protected function getGoodList(Request $request, $status = null)
    {
        $goods = Good::with('variants')->orderBy('sort', 'ASC')->orderBy('created_at', 'ASC');

        if ($request->has('key')) {
            $goods->where('name', 'like', "%{$request->key}%");
        }

        if ($request->has('category_id')) {
            $goods->whereGoodCategoryId($request->category_id);
        } elseif (!$request->has('key')) {
            $goods->whereNull('good_category_id');
        }

        if ($request->has('workspace_id')) {
            $goods->workspaceId($request->workspace_id);
        } else {
            $goods->myWorkspace();
        }

        switch ($status) {
            case 'all':
                // do nothing
                break;

            case 'draft':
                $goods->whereStatus('draft');
                break;

            case 'inactive':
                $goods->whereStatus('inactive');
                break;

            default:
                $goods->whereStatus('active');
                break;
        }

        return $goods->paginate($request->get('per_page') ?: 10);
    }

    /**
     * get detail.
     *
     * @param DetailProductRequest $request
     *
     * @return json
     */
    public function getDetail(DetailGoodRequest $request)
    {
        $transform = new GoodDetailTransformer($request->getGood());

        return new JsonResponse(['data' => $transform->toArray()]);
    }

    /**
     * create good.
     *
     * @param CreateGoodRequest $request
     *
     * @return json
     */
    public function createGood(CreateGoodRequest $request)
    {
        $good = Good::create($request->only([
            'name', 'description', 'image', 'good_category_id',
        ]));

        $good->workspaces()->sync($request->workspace_ids);

        return new JsonResponse([
            'message' => 'Good has been created',
            'data' => (new GoodDetailTransformer($good))->toArray(),
        ], 201);
    }

    /**
     * update good.
     *
     * @param UpdateGoodRequest $request
     *
     * @return json
     */
    public function updateGood(UpdateGoodRequest $request)
    {
        $good = $request->getGood();

        if ('draft' !== $request->status
            and 0 === $good->variants()->count()) {
            throw new BadRequestHttpException('Can not update status with No Varinats');
        }

        $good->update($request->only([
            'name', 'description', 'image', 'good_category_id', 'status',
        ]));

        $good->workspaces()->sync($request->workspace_ids);

        return new JsonResponse([
            'message' => 'Good has been updated',
            'data' => (new GoodDetailTransformer($good))->toArray(),
        ]);
    }

    /**
     * delete good.
     *
     * @param DeleteGoodRequest $request
     *
     * @return json
     */
    public function deleteGood(DetailGoodRequest $request)
    {
        $good = $request->getGood();

        $good->delete();

        return new JsonResponse(['message' => 'Good has been deleted']);
    }

    /**
     * update sorting.
     *
     * @param DeleteGoodRequest $request
     *
     * @return json
     */
    public function updateSorting(UpdateSortingGoodRequest $request)
    {
        foreach ($request->data as $sort) {
            Good::find($sort['id'])->update(['sort' => $sort['sort']]);
        }

        return new JsonResponse(['message' => 'Good has been sorted']);
    }
}
