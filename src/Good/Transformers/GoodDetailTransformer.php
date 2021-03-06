<?php

namespace Denmasyarikin\Inventory\Good\Transformers;

use App\Http\Transformers\Detail;
use Illuminate\Database\Eloquent\Model;
use Modules\Workspace\Transformers\WorkspaceListTransformer;

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
            'sort' => $model->sort,
            'description' => $model->description,
            'good_category' => (new GoodCategoryDetailTransformer($model->goodCategory))->toArray(),
            'good_category_id' => $model->good_category_id,
            'image' => $model->image,
            'status' => $model->status,
            'variant_count' => $model->variants()->count(),
            'workspace_ids' => $model->workspaces->pluck('id'),
            'workspaces' => (new WorkspaceListTransformer($model->workspaces))->toArray(),
            'option_count' => $model->options()->count(),
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $model->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
