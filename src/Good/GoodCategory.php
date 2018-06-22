<?php

namespace Denmasyarikin\Inventory\Good;

use App\Model;
use Modules\Workspace\WorkspaceRelation;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodCategory extends Model
{
    use SoftDeletes, WorkspaceRelation;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_good_categories';

    /**
     * Get the goods record associated with the GoodCategory.
     */
    public function goods()
    {
        return $this->hasMany(Good::class);
    }

    /**
     * Get the parent record associated with the GoodCategory.
     */
    public function parent()
    {
        return $this->belongsTo(static::class)->withTrashed();
    }

    /**
     * Get the children record associated with the GoodCategory.
     */
    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    /**
     * Get the workspaces record associated with the Good.
     */
    public function workspaces()
    {
        return $this->belongsToMany('Modules\Workspace\Workspace', 'inventory_good_category_workspaces')->whereStatus('active')->withTimestamps();
    }
}
