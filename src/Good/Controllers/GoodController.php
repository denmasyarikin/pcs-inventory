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
use Denmasyarikin\Inventory\Good\Transformers\GoodListTransformer;
use Denmasyarikin\Inventory\Good\Transformers\GoodDetailTransformer;

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
        $goods = $this->getGoodList($request);

        $transform = new GoodListTransformer($goods);

        return new JsonResponse([
            'data' => $transform->toArray(),
            'pagination' => $transform->pagination(),
        ]);
    }

    /**
     * get bank list.
     *
     * @param Request $request
     *
     * @return paginator
     */
    protected function getGoodList(Request $request)
    {
        $goods = Good::orderBy('name', 'ASC');

        if ($request->has('key')) {
            $goods->where('id', $request->key);
            $goods->orwhere('name', 'like', "%{$request->key}%");
        }

        return $goods->paginate($request->get('per_page') ?: 10);
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
        $product = Good::create($request->only([
            'name', 'description', 'good_category_id'
        ]));

        return new JsonResponse([
            'message' => 'Good has been created',
            'data' => (new GoodDetailTransformer($product))->toArray(),
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
        $product = $request->getGood();

        $product->update($request->only([
            'name', 'description', 'good_category_id', 'status'
        ]));

        return new JsonResponse(['message' => 'Good has been updated']);
    }

    /**
     * update good.
     *
     * @param DeleteGoodRequest $request
     *
     * @return json
     */
    public function deleteGood(DetailGoodRequest $request)
    {
        $product = $request->getGood();

        $product->delete();

        return new JsonResponse(['message' => 'Good has been deleted']);
    }
}
