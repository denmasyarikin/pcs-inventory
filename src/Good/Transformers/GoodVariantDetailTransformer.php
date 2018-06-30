<?php

namespace Denmasyarikin\Inventory\Good\Transformers;

use App\Http\Transformers\Detail;
use Illuminate\Database\Eloquent\Model;
use Denmasyarikin\Inventory\Good\GoodPriceCalculator;
use Modules\Unit\Transformers\UnitListDetailTransformer;

class GoodVariantDetailTransformer extends Detail
{
    /**
     * get data.
     *
     * @param Model $model
     *
     * @return array
     */
    protected function getData(Model $model)
    {
        $calculator = new GoodPriceCalculator($model);

        return [
            'id' => $model->id,
            'name' => $model->name,
            'image' => $model->image,
            'good' => (new GoodDetailTransformer($model->good))->toArray(),
            'unit_id' => $model->unit_id,
            'unit' => (new UnitListDetailTransformer($model->unit))->toArray(),
            'tracked' => (bool) $model->tracked,
            'enabled' => (bool) $model->enabled,
            'on_hand' => (int) $model->on_hand,
            'on_hold' => (int) $model->on_hold,
            'ready_stock' => (int) $model->ready_stock,
            'good_option_items_id' => $model->goodOptionItems->pluck('id'),
            'option_items' => (new GoodOptionItemListTransformer($model->goodOptionItems))->toArray(),
            'base_price' => $calculator->getBasePrice() ? $calculator->getBasePrice()->price : null,
            'prices' => (new GoodPriceListTransformer($calculator->getAllPrices()))->toArray(),
            'min_order' => (float) $model->min_order,
            'order_multiples' => (float) $model->order_multiples,
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $model->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
