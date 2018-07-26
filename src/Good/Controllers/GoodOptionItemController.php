<?php

namespace Denmasyarikin\Inventory\Good\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Denmasyarikin\Inventory\Good\GoodOptionItem;
use Denmasyarikin\Inventory\Good\Requests\DetailGoodOptionRequest;
use Denmasyarikin\Inventory\Good\Requests\CreateGoodOptionItemRequest;
use Denmasyarikin\Inventory\Good\Requests\UpdateGoodOptionItemRequest;
use Denmasyarikin\Inventory\Good\Requests\DeleteGoodOptionItemRequest;
use Denmasyarikin\Inventory\Good\Requests\UpdateSortingGoodOptionItemRequest;
use Denmasyarikin\Inventory\Good\Transformers\GoodOptionItemListTransformer;
use Denmasyarikin\Inventory\Good\Transformers\GoodOptionItemDetailTransformer;

class GoodOptionItemController extends Controller
{
    /**
     * get list.
     *
     * @param DetailGoodOptionRequest $request
     *
     * @return json
     */
    public function getList(DetailGoodOptionRequest $request)
    {
        $goodOption = $request->getGoodOption();

        return new JsonResponse([
            'data' => (new GoodOptionItemListTransformer($goodOption->goodOptionItems))->toArray(),
        ]);
    }

    /**
     * create option.
     *
     * @param CreateGoodOptionItemRequest $request
     *
     * @return json
     */
    public function createOptionItem(CreateGoodOptionItemRequest $request)
    {
        $goodOption = $request->getGoodOption();

        $option = $goodOption->goodOptionItems()->create(
            $request->only(['name'])
        );

        return new JsonResponse([
            'messaage' => 'Good option item has been created',
            'data' => (new GoodOptionItemDetailTransformer($option))->toArray(),
        ], 201);
    }

    /**
     * update option.
     *
     * @param UpdateGoodOptionItemRequest $request
     *
     * @return json
     */
    public function updateOptionItem(UpdateGoodOptionItemRequest $request)
    {
        $item = $request->getGoodOptionItem();

        $item->update($request->only(['name']));

        return new JsonResponse([
            'messaage' => 'Good option item has been updated',
            'data' => (new GoodOptionItemDetailTransformer($item))->toArray(),
        ]);
    }

    /**
     * delete option.
     *
     * @param DeleteGoodOptionItemRequest $request
     *
     * @return json
     */
    public function deleteOptionItem(DeleteGoodOptionItemRequest $request)
    {
        $option = $request->getGoodOptionItem();
        $option->delete();

        return new JsonResponse(['messaage' => 'Good option has been deleted']);
    }

    /**
     * update sorting.
     *
     * @param DeleteGoodRequest $request
     *
     * @return json
     */
    public function updateSorting(UpdateSortingGoodOptionItemRequest $request)
    {
        foreach ($request->data as $sort) {
            GoodOptionItem::find($sort['id'])->update(['sort' => $sort['sort']]);
        }

        return new JsonResponse(['message' => 'Good option item has been sorted']);
    }
}
