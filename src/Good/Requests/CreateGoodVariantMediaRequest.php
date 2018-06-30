<?php

namespace Denmasyarikin\Inventory\Good\Requests;

class CreateGoodVariantMediaRequest extends DetailGoodVariantRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:image,youtube',
            'content' => 'required',
            'sequence' => 'required|numeric',
            'primary' => 'required|boolean',
        ];
    }
}
