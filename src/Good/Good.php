<?php

namespace Denmasyarikin\Inventory\Good;

use App\Model;
use Modules\Workspace\WorkspaceRelation;
use Illuminate\Database\Eloquent\SoftDeletes;

class Good extends Model
{
    use SoftDeletes, WorkspaceRelation;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_goods';

    /**
     * Get the goodCategory record associated with the Good.
     */
    public function goodCategory()
    {
        return $this->belongsTo(GoodCategory::class)->withTrashed();
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
        return $this->hasMany(GoodOption::class)->orderBy('sort', 'ASC')->orderBy('created_at', 'ASC');
    }

    /**
     * Get the variants record associated with the Good.
     */
    public function variants()
    {
        return $this->hasMany(GoodVariant::class)->orderBy('sort', 'ASC')->orderBy('created_at', 'ASC');
    }

    /**
     * Get the workspaces record associated with the Good.
     */
    public function workspaces()
    {
        return $this->belongsToMany('Modules\Workspace\Workspace', 'inventory_good_workspaces')->whereStatus('active')->withTimestamps();
    }
}
