<?php

namespace Denmasyarikin\Inventory\Good;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodAttribute extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_good_attributs';

    /**
     * Get the good record associated with the GoodAttribute.
     */
    public function good()
    {
    	return $this->belongsTo(Good::class);
    }
}
