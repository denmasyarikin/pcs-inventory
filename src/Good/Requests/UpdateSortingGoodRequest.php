<?php 

namespace Denmasyarikin\Inventory\Good\Requests;

use App\Http\Requests\FormRequest;

class UpdateSortingGoodRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.*.id' => 'required|exists:inventory_goods,id',
            'data.*.sort' => 'required|integer'
        ];
    }
}