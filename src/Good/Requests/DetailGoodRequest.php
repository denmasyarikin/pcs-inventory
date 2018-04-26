<?php

namespace Denmasyarikin\Inventory\Good\Requests;

use App\Http\Requests\FormRequest;
use Denmasyarikin\Inventory\Good\Good;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DetailGoodRequest extends FormRequest
{
    /**
     * good group.
     *
     * @var Good
     */
    public $good;

    /**
     * get good.
     *
     * @return Good
     */
    public function getGood(): ?Good
    {
        if ($this->good) {
            return $this->good;
        }

        $id = $this->route('id');

        if ($this->good = Good::find($id)) {
            return $this->good;
        }

        throw new NotFoundHttpException('Good Not Found');
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
