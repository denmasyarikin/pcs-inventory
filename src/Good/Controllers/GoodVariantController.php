<?php

namespace Denmasyarikin\Inventory\Good\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Denmasyarikin\Inventory\Good\Good;
use Denmasyarikin\Inventory\Good\GoodVariant;
use Denmasyarikin\Inventory\Good\Requests\DetailGoodRequest;
use Denmasyarikin\Inventory\Good\Requests\DetailVariantRequest;
use Denmasyarikin\Inventory\Good\Requests\CreateGoodVariantRequest;
use Denmasyarikin\Inventory\Good\Requests\UpdateGoodVariantRequest;
use Denmasyarikin\Inventory\Good\Requests\DeleteGoodVariantRequest;
use Denmasyarikin\Inventory\Good\Transformers\GoodVariantListTransformer;
use Denmasyarikin\Inventory\Good\Transformers\GoodVariantDetailTransformer;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class GoodVariantController extends Controller
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
            'data' => (new GoodVariantListTransformer($good->variants))->toArray(),
        ]);
    }

    /**
     * get detail.
     *
     * @param DetailProductRequest $request
     *
     * @return json
     */
    public function getDetail(DetailVariantRequest $request)
    {
        $transform = new GoodVariantDetailTransformer($request->getGoodVariant());

        return new JsonResponse(['data' => $transform->toArray()]);
    }

    /**
     * create variant.
     *
     * @param CreateGoodVariantRequest $request
     *
     * @return json
     */
    public function createVariant(CreateGoodVariantRequest $request)
    {
        $good = $request->getGood();
        $goodOptionItemsId = array_map('intval', $request->good_option_items_id);

        $this->checkIsVariantExist($good, $goodOptionItemsId);

        $variant = $good->variants()->create(
            $request->only(['name', 'tracked', 'on_hand', 'on_hold', 'ready_stock', 'unit_id', 'min_order', 'order_multiples'])
        );

        $variant->goodOptionItems()->sync($request->good_option_items_id);

        return new JsonResponse([
            'messaage' => 'Good variant has been created',
            'data' => (new GoodVariantDetailTransformer($variant))->toArray(),
        ], 201);
    }

    /**
     * update variant.
     *
     * @param UpdateGoodVariantRequest $request
     *
     * @return json
     */
    public function updateVariant(UpdateGoodVariantRequest $request)
    {
        $good = $request->getGood();
        $variant = $request->getGoodVariant();
        $goodOptionItemsId = array_map('intval', $request->good_option_items_id);

        $this->checkIsVariantExist($good, $goodOptionItemsId, $variant);

        if ((bool) $request->enabled === true) {
            if ($variant->goodPrices()->count() === 0) {
                throw new BadRequestHttpException('Can not be enabled with no prices');
            }
        }

        $variant->update($request->only(['name', 'tracked', 'enabled', 'on_hand', 'on_hold', 'ready_stock' ,'unit_id', 'min_order', 'order_multiples']));
        $variant->goodOptionItems()->sync($request->good_option_items_id);

        return new JsonResponse([
            'messaage' => 'Good variant has been updated',
            'data' => (new GoodVariantDetailTransformer($variant))->toArray(),
        ]);
    }

    /**
     * delete variant.
     *
     * @param DeleteGoodVariantRequest $request
     *
     * @return json
     */
    public function deleteVariant(DeleteGoodVariantRequest $request)
    {
        $variant = $request->getGoodVariant();
        $variant->delete();

        return new JsonResponse(['messaage' => 'Good variant has been deleted']);
    }

    /**
     * check is variant exists
     *
     * @param Good $good
     * @param array $goodOptionItemsId
     * @return void
     */
    protected function checkIsVariantExist(Good $good, array $goodOptionItemsId, GoodVariant $exceptVariant = null)
    {        
        foreach ($good->variants as $variant) {
            if (! is_null($exceptVariant) AND $exceptVariant->id === $variant->id) {
                continue;
            }

            $options = $variant->goodOptionItems->pluck('id')->toArray();

            if ($options === $goodOptionItemsId) {
                throw new BadRequestHttpException("Good Variant already exists");
            }
        }
    }
}
