<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use App\Http\Requests\FormRequest;

class CreateGoodRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'description' => 'nullable',
            'image' => 'nullable',
            'good_category_id' => 'nullable|numeric|exists:inventory_good_categories,id',
            'workspace_ids' => 'required|array|min:1',
            'workspace_ids.*' => 'exists:core_workspaces,id',
        ];
    }
}
