<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class UpdateGoodAttributeRequest extends DetailGoodAttributeRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'key' => 'required',
            'value' => 'required',
        ];
    }
}
