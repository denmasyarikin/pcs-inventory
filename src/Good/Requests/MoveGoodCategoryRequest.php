<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class MoveGoodCategoryRequest extends DetailGoodRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'good_category_id' => 'nullable|numeric|exists:inventory_good_categories,id'
       ];
    }
}
