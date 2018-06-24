<?php

namespace Denmasyarikin\Inventory\Good;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodOptionItem extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_good_option_items';

    /**
     * Get the goodOption record associated with the Denma_02_01_005_GoodOptionItem.
     */
    public function goodOption()
    {
        return $this->belongsTo(GoodOption::class)->withTrashed();
    }
}
