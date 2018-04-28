<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use Denmasyarikin\Inventory\Good\Good;
use Denmasyarikin\Inventory\Good\GoodOption;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DetailGoodOptionRequest extends DetailGoodRequest
{
    /**
     * goodOption.
     *
     * @var GoodOption
     */
    public $goodOption;

    /**
     * get goodOption.
     *
     * @return GoodOption
     */
    public function getGoodOption(Good $good = null): ?GoodOption
    {
        if ($this->goodOption) {
            return $this->goodOption;
        }

        $good = null === $good ? $this->getGood() : $good;
        $id = (int) $this->route('option_id');

        if ($this->goodOption = $good->options()->find($id)) {
            return $this->goodOption;
        }

        throw new NotFoundHttpException('Good Option Not Found');
    }
}
