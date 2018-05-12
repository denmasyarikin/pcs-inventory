<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class CreateGoodVariantRequest extends DetailGoodRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|max:30',
            'tracked' => 'required|boolean',
            'on_hold' => 'integer',
            'on_hand' => 'integer',
            'ready_stock' => 'integer',
            'unit_id' => 'required|exists:core_units,id',
            'good_option_items_id' => 'nullable|array',
            'good_option_items_id' => 'exists:inventory_good_option_items,id'
        ];
    }
}
