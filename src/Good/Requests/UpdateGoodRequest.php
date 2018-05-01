<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class UpdateGoodRequest extends DetailGoodRequest
{
    /**
     * get good.
     *
     * @return Good
     */
    public function getGood(): ?Good
    {
        $good = parent::getGood();

        $this->checkFreshData($good, 'good_last_updated');

        return $good;
    }

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
            'name' => 'required|max:50',
            'description' => 'nullable',
            'good_category_id' => 'nullable|numeric|exists:inventory_good_categories,id',
            'status' => 'nullable|in:active,inactive',
       ];
    }
}
