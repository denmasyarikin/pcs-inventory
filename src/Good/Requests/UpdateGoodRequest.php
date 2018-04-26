<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class UpdateGoodRequest extends DetailGoodRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'description' => 'nullable',
            'good_category_id' => 'nullable|numeric|exists:inventory_good_categories,id',
            'status' => 'nullable|in:active,inactive',
       ];
    }
}
