<?php

namespace Denmasyarikin\Inventory\Good;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodVariant extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_good_variants';

    /**
     * Get the good record associated with the GoodVariant.
     */
    public function good()
    {
    	return $this->belongsTo(Good::class);
    }

    /**
     * Get the prices record associated with the GoodVariant.
     */
    public function prices()
    {
    	return $this->hasMany(GoodPrice::class);
    }
}
