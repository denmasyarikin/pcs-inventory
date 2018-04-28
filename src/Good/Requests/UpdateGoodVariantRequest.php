<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use Denmasyarikin\Inventory\Good\Good;

class UpdateGoodVariantRequest extends DetailGoodVariantRequest
{
    /**
     * get good.
     *
     * @return Good
     */
    public function getGood(): ?Good
    {
        $good = parent::getGood();

        $this->checkFreshData($good);

        return $good;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:30',
            'tracked' => 'required|boolean',
            'enabled' => 'required|boolean',
            'on_hold' => 'nullable|integer',
            'on_hand' => 'nullable|integer',
            'good_option_items_id' => 'required|array:min:1',
            'good_option_items_id' => 'exists:inventory_good_option_items,id'
        ];
    }
}
