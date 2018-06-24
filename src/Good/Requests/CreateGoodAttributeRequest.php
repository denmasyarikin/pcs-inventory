<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class CreateGoodAttributeRequest extends DetailGoodRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'key' => 'required',
            'value' => 'required',
        ];
    }
}
