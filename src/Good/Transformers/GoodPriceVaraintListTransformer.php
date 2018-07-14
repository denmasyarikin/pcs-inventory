<?php

namespace Denmasyarikin\Inventory\Good\Transformers;

use App\Http\Transformers\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection as IlluminateCollection;
use Denmasyarikin\Inventory\Good\GoodPriceCalculator;

class GoodPriceVaraintListTransformer extends Collection
{
    /**
     * get data.
     *
     * @return array
     */
    protected function getData(Model $model)
    {
        $calculator = new GoodPriceCalculator($model);

        return [
            'id' => $model->id,
            'name' => $model->name,
            'prices' => $this->getPrice($calculator->getAllPrices())
        ];
    }

    /**
     * get price
     *
     * @param IlluminateCollection $prices
     * @return array
     */
    protected function getPrice(IlluminateCollection $prices)
    {
    	$data = [];

    	foreach ($prices as $price) {
    		if ($price === null) continue;

    		$data[] = [
    			'chanel_id' => $price->chanel_id,
    			'price' => $price->price
    		];
    	}

    	return $data;
    }
}
