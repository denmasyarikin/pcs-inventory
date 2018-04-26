<?php

namespace Denmasyarikin\Inventory\Good\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Denmasyarikin\Inventory\Good\GoodCategory;
use Denmasyarikin\Inventory\Good\Requests\CreateGoodCategoryRequest;
use Denmasyarikin\Inventory\Good\Requests\UpdateGoodCategoryRequest;
use Denmasyarikin\Inventory\Good\Requests\DeleteGoodCategoryRequest;
use Denmasyarikin\Inventory\Good\Transformers\GoodCategoryListTransformer;
use Denmasyarikin\Inventory\Good\Transformers\GoodCategoryDetailTransformer;

class GoodCategoryController extends Controller
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
        $categories = $this->getGoodCategoryList($request);

        $transform = new GoodCategoryListTransformer($categories);

        return new JsonResponse(['data' => $transform->toArray()]);
    }

    /**
     * get bank list.
     *
     * @param Request $request
     *
     * @return paginator
     */
    protected function getGoodCategoryList(Request $request)
    {
        $categories = GoodCategory::orderBy('name', 'ASC');

        if ($request->has('key')) {
            $categories->where('id', $request->key);
            $categories->orwhere('name', 'like', "%{$request->key}%");
        }

        return $categories->get();
    }

    /**
     * create product category.
     *
     * @param CreateGoodCategoryRequest $request
     *
     * @return json
     */
    public function createCategory(CreateGoodCategoryRequest $request)
    {
        $productCategory = GoodCategory::create($request->only(['name', 'image', 'parent_id']));

        return new JsonResponse([
            'message' => 'Good category has been created',
            'data' => (new GoodCategoryDetailTransformer($productCategory))->toArray(),
        ], 201);
    }

    /**
     * update product category.
     *
     * @param UpdateGoodCategoryRequest $request
     *
     * @return json
     */
    public function updateCategory(UpdateGoodCategoryRequest $request)
    {
        $productCategory = $request->getGoodCategory();

        $productCategory->update($request->only(['name', 'image', 'parent_id']));

        return new JsonResponse(['message' => 'Good category has been updated']);
    }

    /**
     * update product category.
     *
     * @param DeleteGoodCategoryRequest $request
     *
     * @return json
     */
    public function deleteCategory(DeleteGoodCategoryRequest $request)
    {
        $productCategory = $request->getGoodCategory();

        $productCategory->delete();

        return new JsonResponse(['message' => 'Good category has been deleted']);
    }
}
