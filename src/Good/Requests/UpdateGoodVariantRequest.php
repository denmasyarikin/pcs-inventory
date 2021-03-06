<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class UpdateGoodVariantRequest extends DetailGoodVariantRequest
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
            'enabled' => 'required|boolean',
            'on_hold' => 'integer',
            'on_hand' => 'integer',
            'ready_stock' => 'integer',
            'unit_id' => 'required|exists:core_units,id',
            'min_order' => 'required|numeric',
            'order_multiples' => 'required|numeric',
            'good_option_items_id' => 'nullable|array|distinct',
            'good_option_items_id' => 'exists:inventory_good_option_items,id',
        ];
    }
}
