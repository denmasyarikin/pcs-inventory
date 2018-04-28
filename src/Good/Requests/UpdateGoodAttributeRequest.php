<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use Denmasyarikin\Inventory\Good\Good;

class UpdateGoodAttributeRequest extends DetailGoodAttributeRequest
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
            'type' => 'required',
            'key' => 'required',
            'value' => 'required',
        ];
    }
}