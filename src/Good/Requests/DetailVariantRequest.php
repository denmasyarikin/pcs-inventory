<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use App\Http\Requests\FormRequest;
use Denmasyarikin\Inventory\Good\GoodVariant;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DetailVariantRequest extends FormRequest
{
    /**
     * goodVariant group.
     *
     * @var GoodVariant
     */
    public $goodVariant;

    /**
     * get goodVariant.
     *
     * @return GoodVariant
     */
    public function getGoodVariant(): ?GoodVariant
    {
        if ($this->goodVariant) {
            return $this->goodVariant;
        }

        $id = (int) $this->route('id');

        if ($this->goodVariant = GoodVariant::find($id)) {
            return $this->goodVariant;
        }

        throw new NotFoundHttpException('Good Variant Not Found');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
