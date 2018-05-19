<?php

namespace Denmasyarikin\Inventory\Good;

use App\Model;
use App\Manager\Contracts\Price;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodPrice extends Model implements Price
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_good_prices';

    /**
     * Get the goodVariant record associated with the GoodPrice.
     */
    public function goodVariant()
    {
        return $this->belongsTo(GoodVariant::class);
    }

    /**
     * get priceabel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPriceabel()
    {
        return $this->goodVariant();
    }

    /**
     * Get the chanel record associated with the GoodPrice.
     */
    public function chanel()
    {
        return $this->belongsTo('Modules\Chanel\Chanel');
    }
    
    /**
     * Get the previous record associated with the GoodPrice.
     */
    public function previous()
    {
        return $this->belongsTo(static::class, 'previous_id');
    }
}
