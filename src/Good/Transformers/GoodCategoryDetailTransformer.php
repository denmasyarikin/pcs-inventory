<?php

namespace Denmasyarikin\Inventory\Good\Transformers;

use App\Http\Transformers\Detail;
use Illuminate\Database\Eloquent\Model;
use Modules\Workspace\Transformers\WorkspaceListTransformer;

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
            'sort' => $model->sort,
            'image' => $model->image,
            'parent_id' => $model->parent_id ? (int) $model->parent_id : null,
            'workspace_ids' => $model->workspaces->pluck('id'),
            'workspaces' => (new WorkspaceListTransformer($model->workspaces))->toArray(),
            'good_count' => (int) $model->goods()->whereStatus('active')->count(),
            'children_count' => (int) $model->children->count(),
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $model->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
