<?php

namespace Denmasyarikin\Inventory\Good;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Good extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_goods';

    /**
     * Get the category record associated with the Good.
     */
    public function category()
    {
    	return $this->belongsTo(GoodCategory::class);
    }

    /**
     * Get the attributes record associated with the Good.
     */
    public function attributes()
    {
    	return $this->hasMany(GoodAttribute::class);
    }

    /**
     * Get the options record associated with the Good.
     */
    public function options()
    {
    	return $this->hasMany(GoodOption::class);
    }

    /**
     * Get the variants record associated with the Good.
     */
    public function variants()
    {
    	return $this->hasMany(GoodVariant::class);
    }

    /**
     * Get the medias record associated with the Good.
     */
    public function medias()
    {
    	return $this->hasMany(GoodMedia::class);
    }
}