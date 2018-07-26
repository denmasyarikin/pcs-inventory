<?php

namespace Denmasyarikin\Inventory\Good\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Denmasyarikin\Inventory\Good\GoodOption;
use Denmasyarikin\Inventory\Good\Requests\DetailGoodRequest;
use Denmasyarikin\Inventory\Good\Requests\CreateGoodOptionRequest;
use Denmasyarikin\Inventory\Good\Requests\UpdateGoodOptionRequest;
use Denmasyarikin\Inventory\Good\Requests\DeleteGoodOptionRequest;
use Denmasyarikin\Inventory\Good\Requests\UpdateSortingGoodOptionRequest;
use Denmasyarikin\Inventory\Good\Transformers\GoodOptionListTransformer;
use Denmasyarikin\Inventory\Good\Transformers\GoodOptionDetailTransformer;

class GoodOptionController extends Controller
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
            'data' => (new GoodOptionListTransformer($good->options))->toArray(),
        ]);
    }

    /**
     * create option.
     *
     * @param CreateGoodOptionRequest $request
     *
     * @return json
     */
    public function createOption(CreateGoodOptionRequest $request)
    {
        $good = $request->getGood();

        $option = $good->options()->create(
            $request->only(['name'])
        );

        return new JsonResponse([
            'messaage' => 'Good option has been created',
            'data' => (new GoodOptionDetailTransformer($option))->toArray(),
        ], 201);
    }

    /**
     * update option.
     *
     * @param UpdateGoodOptionRequest $request
     *
     * @return json
     */
    public function updateOption(UpdateGoodOptionRequest $request)
    {
        $option = $request->getGoodOption();

        $option->update($request->only(['name']));

        return new JsonResponse([
            'messaage' => 'Good option has been updated',
            'data' => (new GoodOptionDetailTransformer($option))->toArray(),
        ]);
    }

    /**
     * delete option.
     *
     * @param DeleteGoodOptionRequest $request
     *
     * @return json
     */
    public function deleteOption(DeleteGoodOptionRequest $request)
    {
        $option = $request->getGoodOption();
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
    public function updateSorting(UpdateSortingGoodOptionRequest $request)
    {
        foreach ($request->data as $sort) {
            GoodOption::find($sort['id'])->update(['sort' => $sort['sort']]);
        }

        return new JsonResponse(['message' => 'Good option has been sorted']);
    }
}
