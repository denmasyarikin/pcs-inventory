<?php

namespace Denmasyarikin\Inventory\Good\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Denmasyarikin\Inventory\Good\Requests\DetailGoodRequest;
use Denmasyarikin\Inventory\Good\Requests\CreateGoodAttributeRequest;
use Denmasyarikin\Inventory\Good\Requests\UpdateGoodAttributeRequest;
use Denmasyarikin\Inventory\Good\Requests\DeleteGoodAttributeRequest;
use Denmasyarikin\Inventory\Good\Transformers\GoodAttributeListTransformer;
use Denmasyarikin\Inventory\Good\Transformers\GoodAttributeDetailTransformer;

class GoodAttributeController extends Controller
{
    /**
     * get list.
     *
     * @param DetailGoodRequest $request
     *
     * @return json
     */
    public function getList(DetailGoodRequest $request)
    {
        $good = $request->getGood();

        return new JsonResponse([
            'data' => (new GoodAttributeListTransformer($good->attributes))->toArray(),
        ]);
    }

    /**
     * create attribute.
     *
     * @param CreateGoodAttributeRequest $request
     *
     * @return json
     */
    public function createAttribute(CreateGoodAttributeRequest $request)
    {
        $good = $request->getGood();

        $attribute = $good->attributes()->create(
            $request->only(['type', 'key', 'value'])
        );

        return new JsonResponse([
            'messaage' => 'Good attribute has been created',
            'data' => (new GoodAttributeDetailTransformer($attribute))->toArray(),
        ], 201);
    }

    /**
     * update attribute.
     *
     * @param UpdateGoodAttributeRequest $request
     *
     * @return json
     */
    public function updateAttribute(UpdateGoodAttributeRequest $request)
    {
        $attribute = $request->getGoodAttribute();

        $attribute->update($request->only(['type', 'key', 'value']));

        return new JsonResponse([
            'messaage' => 'Good attribute has been updated',
            'data' => (new GoodAttributeDetailTransformer($attribute))->toArray(),
        ]);
    }

    /**
     * delete attribute.
     *
     * @param DeleteGoodAttributeRequest $request
     *
     * @return json
     */
    public function deleteAttribute(DeleteGoodAttributeRequest $request)
    {
        $attribute = $request->getGoodAttribute();
        $attribute->delete();

        return new JsonResponse(['messaage' => 'Good attribute has been deleted']);
    }
}
