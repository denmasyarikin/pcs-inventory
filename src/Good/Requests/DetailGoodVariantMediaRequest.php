<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use Denmasyarikin\Inventory\Good\GoodVariantMedia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DetailGoodVariantMediaRequest extends DetailGoodVariantRequest
{
    /**
     * goodVariantMedia.
     *
     * @var goodVariantMedia
     */
    public $goodVariantMedia;

    /**
     * get goodVariantMedia.
     *
     * @return GoodVariantMedia
     */
    public function getGoodVariantMedia(): ?GoodVariantMedia
    {
        if ($this->goodVariantMedia) {
            return $this->goodVariantMedia;
        }

        $variant = $this->getGoodVariant();
        $id = (int) $this->route('media_id');

        if ($this->goodVariantMedia = $variant->medias()->find($id)) {
            return $this->goodVariantMedia;
        }

        throw new NotFoundHttpException('Good Media Not Found');
    }
}
