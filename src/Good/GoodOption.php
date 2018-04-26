<?php

namespace Denmasyarikin\Inventory\Good;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodOption extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_good_options';

    /**
     * Get the good record associated with the GoodOption.
     */
    public function good()
    {
    	return $this->belongsTo(Good::class);
    }

    /**
     * Get the optionItems record associated with the GoodOption.
     */
    public function optionItems()
    {
    	return $this->hasMany(GoodOptionItem::class);
    }

    /**
     * Get the variants record associated with the GoodOption.
     */
    public function variants()
    {
    	return $this->belongsToMany(GoodVariant::class, 'inventory_good_variant_options')->withTimestamps();
    }
}
