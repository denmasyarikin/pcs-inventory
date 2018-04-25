<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class UpdateGoodCategoryRequest extends DetailGoodCategoryRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:20',
            'image' => '',
            'parent_id' => 'numeric|exists:inventory_good_categories,id',
        ];
    }
}
