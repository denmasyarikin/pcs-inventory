<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use Denmasyarikin\Inventory\Good\Good;

class UpdateGoodCategoryRequest extends DetailGoodCategoryRequest
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
            'name' => 'required|min:3|max:20',
            'image' => '',
            'parent_id' => 'numeric|exists:inventory_good_categories,id',
        ];
    }
}
