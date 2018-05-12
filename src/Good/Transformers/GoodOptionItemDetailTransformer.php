<?php

namespace Denmasyarikin\Inventory\Good\Transformers;

use App\Http\Transformers\Detail;
use Illuminate\Database\Eloquent\Model;

class GoodOptionItemDetailTransformer extends Detail
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
        $goodOption = $model->goodOption;

        return [
            'id' => $model->id,
            'option' => [
                'id' => $goodOption->id,
                'name' => $goodOption->name
            ],
            'name' => $model->name,
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $model->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
