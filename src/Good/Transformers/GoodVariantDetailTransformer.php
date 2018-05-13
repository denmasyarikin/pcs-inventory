<?php

namespace Denmasyarikin\Inventory\Good\Transformers;

use App\Http\Transformers\Detail;
use Illuminate\Database\Eloquent\Model;
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
        $good = $model->good;

        return [
            'id' => $model->id,
            'name' => $model->name,
            'good' => ['id' => $good->id, 'name' => $good->name],
            'unit_id' => $model->unit_id,
            'unit' => (new UnitListDetailTransformer($model->unit))->toArray(),
            'tracked' => (bool) $model->tracked,
            'enabled' => (bool) $model->enabled,
            'on_hand' => (int) $model->on_hand,
            'on_hold' => (int) $model->on_hold,
            'ready_stock' => (int) $model->ready_stock,
            'good_option_items_id' => $model->goodOptionItems->pluck('id'),
            'option_items' => (new GoodOptionItemListTransformer($model->goodOptionItems))->toArray(),
            'prices' => (new GoodPriceListFormatedTransformer($model->goodPrices))->toArray(),
            'min_order' => (float) $model->min_order,
            'order_multiples' => (float) $model->order_multiples,
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $model->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
