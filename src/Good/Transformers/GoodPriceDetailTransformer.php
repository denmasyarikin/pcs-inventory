<?php

namespace Denmasyarikin\Inventory\Good\Transformers;

use App\Http\Transformers\Detail;
use Illuminate\Database\Eloquent\Model;
use Modules\Chanel\Transformers\ChanelDetailTransformer;
use Modules\Unit\Transformers\UnitListDetailTransformer;

class GoodPriceDetailTransformer extends Detail
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
        return [
            'id' => $model->id,
            'chanel' => (new ChanelDetailTransformer($model->chanel, ['id', 'name', 'type', 'markup', 'required_down_payment', 'due_date_day_count']))->toArray(),
            'unit' => (new UnitListDetailTransformer($model->unit))->toArray(),
            'price' => (int) $model->price,
            'current' => (bool) $model->current,
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $model->updated_at->format('Y-m-d H:i:s')
        ];
    }
}