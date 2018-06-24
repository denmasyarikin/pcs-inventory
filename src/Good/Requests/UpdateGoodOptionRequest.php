<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class UpdateGoodOptionRequest extends DetailGoodOptionRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['name' => 'required|max:30'];
    }
}
