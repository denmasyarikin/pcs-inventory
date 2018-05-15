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
     * Get the goodOptionItems record associated with the GoodVariant.
     */
    public function goodOptionItems()
    {
        return $this->belongsToMany(GoodOptionItem::class, 'inventory_good_variant_options')->withTrashed();
    }

    /**
     * Get the goodPrices record associated with the GoodVariant.
     */
    public function goodPrices()
    {
        return $this->hasMany(GoodPrice::class);
    }

    /**
     * Get the unit record associated with the GoodPrice.
     */
    public function unit()
    {
        return $this->belongsTo('Modules\Unit\Unit');
    }
}
