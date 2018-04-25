<?php

namespace Denmasyarikin\Inventory\Good;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodCategory extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_good_categories';

    /**
     * Get the good record associated with the GoodCategory.
     */
    public function good()
    {
    	return $this->hasMany(Good::class);
    }

    /**
     * Get the parent record associated with the GoodCategory.
     */
    public function parent()
    {
    	return $this->belongsTo(static::class);
    }

    /**
     * Get the children record associated with the GoodCategory.
     */
    public function children()
    {
    	return $this->hasMany(static::class);
    }
}
