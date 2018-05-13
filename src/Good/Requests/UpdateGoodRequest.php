<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class UpdateGoodRequest extends DetailGoodRequest
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
            'status' => 'nullable|in:draft,active,inactive',
       ];
    }
}
