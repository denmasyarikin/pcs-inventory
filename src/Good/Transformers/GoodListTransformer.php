<?php

namespace Denmasyarikin\Inventory\Good\Transformers;

use App\Http\Transformers\Pagination;
use Illuminate\Database\Eloquent\Model;

class GoodListTransformer extends Pagination
{
    /**
     * get data.
     *
     * @return array
     */
    protected function getData(Model $model)
    {
        return (new GoodListDetailTransformer($model))->toArray();
    }
}
