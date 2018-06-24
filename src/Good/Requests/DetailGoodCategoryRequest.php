<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use App\Http\Requests\FormRequest;
use Denmasyarikin\Inventory\Good\GoodCategory;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DetailGoodCategoryRequest extends FormRequest
{
    /**
     * good group.
     *
     * @var GoodCategory
     */
    public $goodCategory;

    /**
     * get good.
     *
     * @return Good
     */
    public function getGoodCategory(): ?GoodCategory
    {
        if ($this->goodCategory) {
            return $this->goodCategory;
        }

        $id = (int) $this->route('id');

        if ($this->goodCategory = GoodCategory::find($id)) {
            return $this->goodCategory;
        }

        throw new NotFoundHttpException('Good Category Not Found');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
