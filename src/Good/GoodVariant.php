<?php

namespace Denmasyarikin\Inventory\Good;

use App\Model;
use App\Manager\Contracts\Priceable;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodVariant extends Model implements Priceable
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
        return $this->belongsTo(Good::class)->withTrashed();
    }

    /**
     * Get the medias record associated with the Good.
     */
    public function medias()
    {
        return $this->hasMany(GoodVariantMedia::class);
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
     * get prices.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getPrices()
    {
        return $this->goodPrices();
    }

    /**
     * Get the unit record associated with the GoodPrice.
     */
    public function unit()
    {
        return $this->belongsTo('Modules\Unit\Unit')->withTrashed();
    }

    /**
     * Get Image.
     *
     * @return string
     */
    public function getImageAttribute()
    {
        if (0 === count($medias = $this->medias)) {
            return null;
        }

        $primary = $medias->where('primary', true)->first();

        if (is_null($primary)) {
            $primary = $medias->first();
        }

        return $primary->content;
    }
}
