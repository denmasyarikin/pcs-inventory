<?php

namespace Denmasyarikin\Inventory\Good\Transformers;

use App\Http\Transformers\Detail;
use Illuminate\Database\Eloquent\Model;

class GoodDetailTransformer extends Detail
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
            'description' => $model->description,
            'good_category' => (new GoodCategoryDetailTransformer($model->goodCategory))->toArray(),
            'good_category_id' => $model->good_category_id,
            'image' => $model->image,
            'status' => $model->status,
            'variant_count' => $model->variants()->count(),
            'option_count' => $model->options()->count(),
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $model->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
