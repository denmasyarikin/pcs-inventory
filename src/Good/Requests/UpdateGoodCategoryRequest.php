<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class UpdateGoodCategoryRequest extends DetailGoodCategoryRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:20',
            'image' => 'nullable',
            'parent_id' => 'nullable|numeric|exists:inventory_good_categories,id',
            'workspace_ids' => 'required|array|min:1',
            'workspace_ids.*' => 'exists:core_workspaces,id',
        ];
    }
}
