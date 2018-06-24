<?php

namespace Denmasyarikin\Inventory\Good;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodMedia extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_good_medias';

    /**
     * Get the good record associated with the GoodMedia.
     */
    public function good()
    {
        return $this->belongsTo(Good::class)->withTrashed();
    }
}
