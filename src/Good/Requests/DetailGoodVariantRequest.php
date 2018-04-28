<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use Denmasyarikin\Inventory\Good\Good;
use Denmasyarikin\Inventory\Good\GoodVariant;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DetailGoodVariantRequest extends DetailGoodRequest
{
    /**
     * goodVariant.
     *
     * @var GoodVariant
     */
    public $goodVariant;

    /**
     * get goodVariant.
     *
     * @return GoodVariant
     */
    public function getGoodVariant(Good $good = null): ?GoodVariant
    {
        if ($this->goodVariant) {
            return $this->goodVariant;
        }

        $good = null === $good ? $this->getGood() : $good;
        $id = (int) $this->route('variant_id');

        if ($this->goodVariant = $good->variants()->find($id)) {
            return $this->goodVariant;
        }

        throw new NotFoundHttpException('Good Variant Not Found');
    }
}
