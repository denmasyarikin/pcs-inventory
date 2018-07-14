<?php

namespace Denmasyarikin\Inventory\Good\Controllers;

use Modules\Chanel\Chanel;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Denmasyarikin\Inventory\Good\GoodVariant;
use Denmasyarikin\Inventory\Good\GoodPriceCalculator;
use Denmasyarikin\Inventory\Good\Requests\DetailGoodRequest;
use Denmasyarikin\Inventory\Good\Requests\DetailGoodVariantRequest;
use Denmasyarikin\Inventory\Good\Requests\CreateGoodPriceRequest;
use Denmasyarikin\Inventory\Good\Requests\UpdateGoodPriceRequest;
use Denmasyarikin\Inventory\Good\Requests\DeleteGoodPriceRequest;
use Denmasyarikin\Inventory\Good\Transformers\GoodPriceListTransformer;
use Denmasyarikin\Inventory\Good\Transformers\GoodPriceDetailTransformer;
use Denmasyarikin\Inventory\Good\Transformers\GoodPriceVaraintListTransformer;
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
     * get pirce list
     *
     * @param DetailGoodRequest $request
     * @return json
     */
    public function getPriceList(DetailGoodRequest $request)
    {
        $good = $request->getGood();
        $variants = $good->variants()->whereEnabled(true)->get();

        return new JsonResponse([
            'data' => (new GoodPriceVaraintListTransformer($variants))->toArray(),
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

        $data = $request->only(['chanel_id', 'price']);
        $data['current'] = true;

        $calculator = new GoodPriceCalculator($goodVariant);
        $defaultPrice = null;

        if (null !== $request->chanel_id) {
            $chanel = Chanel::whereStatus('active')->find(intval($request->chanel_id));
            if (!is_null($chanel)) {
                $defaultPrice = $calculator->getChanelPrice($chanel);
            }
        }

        if ($defaultPrice) {
            $data['previous_id'] = $defaultPrice->id;
            $data['change_type'] = $request->price > $defaultPrice->price ? 'up' : 'down';
            $data['difference'] = $request->price - $defaultPrice->price;
        }

        $price = $goodVariant->goodPrices()->create($data);

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
        $price = $request->getGoodPrice();
        $variant = $request->getGoodVariant();

        $calculator = new GoodPriceCalculator($variant);
        $defaultPrice = null;

        if (null === $price->chanel_id) {
            $defaultPrice = $calculator->getBasePrice();
            $variant->goodPrices()
                    ->update(['current' => false]);
        } else {
            $defaultPrice = $calculator->getChanelPrice($price->chanel);
            $variant->goodPrices()
                    ->whereChanelId($price->chanel_id)
                    ->update(['current' => false]);
        }

        $newPrice = $price->replicate();
        $newPrice->price = $request->price;
        $newPrice->current = true;
        $newPrice->previous_id = $newPrice->id;
        $newPrice->change_type = $newPrice->price > $defaultPrice->price ? 'up' : 'down';
        $newPrice->difference = $newPrice->price - $defaultPrice->price;
        $newPrice->save();

        return new JsonResponse([
            'messaage' => 'Good price has been updated',
            'data' => (new GoodPriceDetailTransformer($newPrice))->toArray(),
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
     * check is service variant price exist.
     *
     * @param GoodVariant $goodVariant
     * @param mixed       $chanelId
     */
    protected function checkIsVariantPriceExist(GoodVariant $goodVariant, $chanelId = null)
    {
        $variantPrices = $goodVariant->goodPrices();

        if (is_null($chanelId)) {
            $variantPrices->whereNull('chanel_id');
        } else {
            $variantPrices->whereChanelId($chanelId);
        }

        if ($variantPrices->whereCurrent(true)->count() > 0) {
            throw new BadRequestHttpException('variant price already exist');
        }

        return;
    }
}
