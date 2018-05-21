<?php

namespace Denmasyarikin\Inventory\Good\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Denmasyarikin\Inventory\Good\GoodCategory;
use Denmasyarikin\Inventory\Good\Requests\DetailGoodCategoryRequest;
use Denmasyarikin\Inventory\Good\Requests\CreateGoodCategoryRequest;
use Denmasyarikin\Inventory\Good\Requests\UpdateGoodCategoryRequest;
use Denmasyarikin\Inventory\Good\Requests\DeleteGoodCategoryRequest;
use Denmasyarikin\Inventory\Good\Transformers\GoodCategoryListTransformer;
use Denmasyarikin\Inventory\Good\Transformers\GoodCategoryDetailTransformer;

class GoodCategoryController extends Controller
{
    /**
     * category list.
     *
     * @param Request $request
     *
     * @return json
     */
    public function getList(Request $request)
    {
        $categories = $this->getGoodCategoryList($request);
        $transform = new GoodCategoryListTransformer($categories);
        $data = ['data' => $transform->toArray()];

        if ($request->has('parent_id')) {
            $category = GoodCategory::find((int) $request->parent_id);

            if ($category) {
                $data['detail'] = (new GoodCategoryDetailTransformer($category))->toArray();
            }

            if ($category->parent_id) {
                $category = GoodCategory::find((int) $category->parent_id);

                if ($category) {
                    $data['parent'] = (new GoodCategoryDetailTransformer($category))->toArray();
                }
            }
        }

        return new JsonResponse($data);
    }

    /**
     * get category list.
     *
     * @param Request $request
     *
     * @return paginator
     */
    protected function getGoodCategoryList(Request $request)
    {
        $categories = GoodCategory::orderBy('name', 'ASC');

        if ($request->has('parent_id')) {
            $categories->whereParentId($request->parent_id);
        } else {
            $categories->whereNull('parent_id');
        }

        if ($request->has('workspace_id')) {
            $categories->workspaceId($request->workspace_id);
        } else {
            $categories->myWorkspace();
        }

        if ($request->has('key')) {
            $categories->orwhere('name', 'like', "%{$request->key}%");
        }

        return $categories->get();
    }

    /**
     * get detail.
     *
     * @param DetailProductRequest $request
     *
     * @return json
     */
    public function getDetail(DetailGoodCategoryRequest $request)
    {
        $transform = new GoodCategoryDetailTransformer($request->getGoodCategory());

        return new JsonResponse(['data' => $transform->toArray()]);
    }

    /**
     * create good category.
     *
     * @param CreateGoodCategoryRequest $request
     *
     * @return json
     */
    public function createCategory(CreateGoodCategoryRequest $request)
    {
        $goodCategory = GoodCategory::create($request->only(['name', 'image', 'parent_id']));

        $goodCategory->workspaces()->sync($request->workspace_ids);

        return new JsonResponse([
            'message' => 'Good category has been created',
            'data' => (new GoodCategoryDetailTransformer($goodCategory))->toArray(),
        ], 201);
    }

    /**
     * update good category.
     *
     * @param UpdateGoodCategoryRequest $request
     *
     * @return json
     */
    public function updateCategory(UpdateGoodCategoryRequest $request)
    {
        $goodCategory = $request->getGoodCategory();

        $goodCategory->update($request->only(['name', 'image', 'parent_id']));
        $goodCategory->workspaces()->sync($request->workspace_ids);

        return new JsonResponse(['message' => 'Good category has been updated']);
    }

    /**
     * update good category.
     *
     * @param DeleteGoodCategoryRequest $request
     *
     * @return json
     */
    public function deleteCategory(DeleteGoodCategoryRequest $request)
    {
        $goodCategory = $request->getGoodCategory();

        foreach ($goodCategory->children as $category) {
            $category->update(['parent_id' => $goodCategory->parent_id]);
        }

        foreach ($goodCategory->goods as $good) {
            $good->update(['category_id' => $goodCategory->parent_id]);
        }

        $goodCategory->delete();

        return new JsonResponse(['message' => 'Good category has been deleted']);
    }
}
