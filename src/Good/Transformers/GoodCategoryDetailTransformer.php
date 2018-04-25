<?php

namespace Denmasyarikin\Inventory\Good\Transformers;

use App\Http\Transformers\Detail;
use Illuminate\Database\Eloquent\Model;

class GoodCategoryDetailTransformer extends Detail
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
            'name' => $model->name,
            'image' => $model->image,
            'parent_id' => (int) $model->parent_id
        ];
    }
}
