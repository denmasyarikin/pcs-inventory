<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use Denmasyarikin\Inventory\Good\GoodMedia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DetailGoodMediaRequest extends DetailGoodRequest
{
    /**
     * productMedia.
     *
     * @var GoodMedia
     */
    public $productMedia;

    /**
     * get productMedia.
     *
     * @return GoodMedia
     */
    public function getGoodMedia(): ?GoodMedia
    {
        if ($this->productMedia) {
            return $this->productMedia;
        }

        $product = $this->getGood();
        $id = $this->route('media_id');

        if ($this->productMedia = $product->medias()->find($id)) {
            return $this->productMedia;
        }

        throw new NotFoundHttpException('Good Media Not Found');
    }
}
