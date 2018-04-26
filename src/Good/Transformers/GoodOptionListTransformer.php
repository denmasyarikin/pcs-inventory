<?php

namespace Denmasyarikin\Inventory\Good\Transformers;

use App\Http\Transformers\Collection;
use Illuminate\Database\Eloquent\Model;

class GoodOptionListTransformer extends Collection
{
    /**
     * get data.
     *
     * @return array
     */
    protected function getData(Model $model)
    {
        return (new GoodOptionDetailTransformer($model))->toArray();
    }
}
