<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use Denmasyarikin\Inventory\Good\GoodMedia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UpdateGoodMediaRequest extends DetailGoodRequest
{
    /**
     * goodMedia.
     *
     * @var GoodMedia
     */
    public $goodMedia;

    /**
     * get goodMedia.
     *
     * @return GoodMedia
     */
    public function getGoodMedia(): ?GoodMedia
    {
        if ($this->goodMedia) {
            return $this->goodMedia;
        }

        $good = $this->getGood();
        $id = (int) $this->route('media_id');

        if ($this->goodMedia = $good->medias()->find($id)) {
            return $this->goodMedia;
        }

        throw new NotFoundHttpException('Good Media Not Found');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:image,youtube',
            'content' => 'required',
            'sequence' => 'required|numeric',
            'primary' => 'required|boolean',
        ];
    }
}
