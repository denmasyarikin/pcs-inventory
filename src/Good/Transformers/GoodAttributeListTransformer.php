<?php

namespace Denmasyarikin\Inventory\Good\Transformers;

use App\Http\Transformers\Collection;
use Illuminate\Database\Eloquent\Model;

class GoodAttributeListTransformer extends Collection
{
    /**
     * get data.
     *
     * @return array
     */
    protected function getData(Model $model)
    {
        return (new GoodAttributeDetailTransformer($model))->toArray();
    }
}
