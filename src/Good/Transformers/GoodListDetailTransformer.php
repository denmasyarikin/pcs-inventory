<?php

namespace Denmasyarikin\Inventory\Good\Transformers;

use App\Http\Transformers\Detail;
use Illuminate\Database\Eloquent\Model;

class GoodListDetailTransformer extends Detail
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
            'workspace_ids' => $model->workspaces->pluck('id'),
            'variant_count' => $model->variants->count(),
            'option_count' => $model->options->count(),
            'description' => $model->description,
            'status' => $model->status,
        ];
    }
}
