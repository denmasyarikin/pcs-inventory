<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class CreateGoodPriceRequest extends DetailGoodVariantRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'unit_id' => 'required|exists:core_units,id',
			'chanel_id' => 'nullable|exists:core_chanels,id',
			'price' => 'required|numeric'
        ];
    }
}
