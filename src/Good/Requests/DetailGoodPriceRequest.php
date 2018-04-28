<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use Denmasyarikin\Inventory\Good\GoodVariant;
use Denmasyarikin\Inventory\Good\GoodPrice;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DetailGoodPriceRequest extends DetailGoodVariantRequest
{
    /**
     * goodPrice.
     *
     * @var GoodPrice
     */
    public $goodPrice;

    /**
     * get goodPrice.
     *
     * @return GoodPrice
     */
    public function getGoodPrice(GoodVariant $goodVariant = null): ?GoodPrice
    {
        if ($this->goodPrice) {
            return $this->goodPrice;
        }

        $goodVariant = null === $goodVariant ? $this->getGoodVariant() : $goodVariant;
        $id = (int) $this->route('price_id');

        if ($this->goodPrice = $goodVariant->goodPrices()->find($id)) {
            return $this->goodPrice;
        }

        throw new NotFoundHttpException('Good Price Not Found');
    }
}
