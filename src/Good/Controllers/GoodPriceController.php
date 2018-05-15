<?php

namespace Denmasyarikin\Inventory\Good\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Denmasyarikin\Inventory\Good\GoodVariant;
use Denmasyarikin\Inventory\Good\Requests\DetailGoodVariantRequest;
use Denmasyarikin\Inventory\Good\Requests\CreateGoodPriceRequest;
use Denmasyarikin\Inventory\Good\Requests\UpdateGoodPriceRequest;
use Denmasyarikin\Inventory\Good\Requests\DeleteGoodPriceRequest;
use Denmasyarikin\Inventory\Good\Transformers\GoodPriceListTransformer;
use Denmasyarikin\Inventory\Good\Transformers\GoodPriceDetailTransformer;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class GoodPriceController extends Controller
{
    /**
     * get list.
     *
     * @param DetailGoodVariantRequest $request
     *
     * @return json
     */
    public function getList(DetailGoodVariantRequest $request)
    {
        $goodVariant = $request->getGoodVariant();

        return new JsonResponse([
            'data' => (new GoodPriceListTransformer($goodVariant->goodPrices()->orderBy('id', 'DESC')->get()))->toArray(),
        ]);
    }

    /**
     * create price.
     *
     * @param CreateGoodPriceRequest $request
     *
     * @return json
     */
    public function createPrice(CreateGoodPriceRequest $request)
    {
        $goodVariant = $request->getGoodVariant();
        $this->checkIsVariantPriceExist($goodVariant, $request->chanel_id);

        $price = $goodVariant->goodPrices()->create(
            $request->only(['chanel_id', 'price'])
        );

        return new JsonResponse([
            'messaage' => 'Good price has been created',
            'data' => (new GoodPriceDetailTransformer($price))->toArray(),
        ], 201);
    }

    /**
     * update price.
     *
     * @param UpdateGoodPriceRequest $request
     *
     * @return json
     */
    public function updatePrice(UpdateGoodPriceRequest $request)
    {
        $variant = $request->getGoodVariant();
        $price = $request->getGoodPrice();

        if (null === $price->chanel_id) {
            $variant->goodPrices()
                    ->update(['current' => false]);
        } else {
            $variant->goodPrices()
                    ->whereChanelId($price->chanel_id)
                    ->update(['current' => false]);
        }

        $newPrice = $price->replicate();
        $newPrice->price = $request->price;
        $newPrice->current = true;
        $newPrice->save();

        return new JsonResponse([
            'messaage' => 'Good price has been updated',
            'data' => (new GoodPriceDetailTransformer($price))->toArray(),
        ]);
    }

    /**
     * delete price.
     *
     * @param DeleteGoodPriceRequest $request
     *
     * @return json
     */
    public function deletePrice(DeleteGoodPriceRequest $request)
    {
        $price = $request->getGoodPrice();

        if ((bool) $price->current) {
            throw new BadRequestHttpException('Current Price not allowed to delete');
        }

        $price->delete();

        return new JsonResponse(['messaage' => 'Good price has been deleted']);
    }

    /**
     * check is good variant price exist.
     *
     * @param param type $goodVariant
     * @param mixed      $chanelId
     */
    protected function checkIsVariantPriceExist(GoodVariant $goodVariant, $chanelId = null)
    {
        $goodPrices = $goodVariant->goodPrices();

        if (is_null($chanelId)) {
            $goodPrices->whereNull('chanel_id');
        } else {
            $goodPrices->whereChanelId($chanelId);
        }

        if ($goodPrices->whereCurrent(true)->count() > 0) {
            throw new BadRequestHttpException('Variant price already exist');
        }

        return;
    }
}
