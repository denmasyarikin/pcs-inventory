<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use Denmasyarikin\Inventory\Good\Good;
use Denmasyarikin\Inventory\Good\GoodOptionItem;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DetailGoodOptionItemRequest extends DetailGoodOptionRequest
{
    /**
     * goodOptionItem.
     *
     * @var GoodOptionItem
     */
    public $goodOptionItem;

    /**
     * get goodOptionItem.
     *
     * @return GoodOptionItem
     */
    public function getGoodOptionItem(GoodOption $goodOption = null): ?GoodOptionItem
    {
        if ($this->goodOptionItem) {
            return $this->goodOptionItem;
        }

        $goodOption = null === $goodOption ? $this->getGoodOption() : $goodOption;
        $id = (int) $this->route('item_id');

        if ($this->goodOptionItem = $goodOption->goodOptionItems()->find($id)) {
            return $this->goodOptionItem;
        }

        throw new NotFoundHttpException('Good Option Item Not Found');
    }
}
