<?php

namespace Denmasyarikin\Inventory\Good;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodVariantMedia extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_good_variant_medias';

    /**
     * Get the good record associated with the GoodMedia.
     */
    public function goodVariant()
    {
        return $this->belongsTo(GoodVariant::class)->withTrashed();
    }
}
