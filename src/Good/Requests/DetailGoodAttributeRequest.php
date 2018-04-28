<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use Denmasyarikin\Inventory\Good\Good;
use Denmasyarikin\Inventory\Good\GoodAttribute;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DetailGoodAttributeRequest extends DetailGoodRequest
{
    /**
     * goodAttribute.
     *
     * @var GoodAttribute
     */
    public $goodAttribute;

    /**
     * get goodAttribute.
     *
     * @return GoodAttribute
     */
    public function getGoodAttribute(Good $good = null): ?GoodAttribute
    {
        if ($this->goodAttribute) {
            return $this->goodAttribute;
        }

        $good = null === $good ? $this->getGood() : $good;
        $id = (int) $this->route('attribute_id');

        if ($this->goodAttribute = $good->attributes()->find($id)) {
            return $this->goodAttribute;
        }

        throw new NotFoundHttpException('Good Attribute Not Found');
    }
}
