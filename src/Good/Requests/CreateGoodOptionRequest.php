<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class CreateGoodOptionRequest extends DetailGoodRequest
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
