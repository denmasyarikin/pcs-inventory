<?php

namespace Denmasyarikin\Inventory\Good;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodPrice extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_good_priceses';

    /**
     * Get the goodVariant record associated with the GoodPrice.
     */
    public function goodVariant()
    {
    	return $this->belongsTo(GoodVariant::class);
    } 

    /**
     * Get the chanel record associated with the GoodPrice.
     */
    public function chanel()
    {
    	return $this->belongsTo('Modules\Chanel\Chanel');
    }

    /**
     * Get the unit record associated with the GoodPrice.
     */
    public function unit()
    {
    	return $this->belongsTo('Modules\Unit\Unit');
    }
}
