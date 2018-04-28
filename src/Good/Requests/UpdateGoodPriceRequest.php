<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class UpdateGoodPriceRequest extends DetailGoodPriceRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['price' => 'required|numeric'];
    }
}
