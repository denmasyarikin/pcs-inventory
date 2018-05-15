<?php

namespace Denmasyarikin\Inventory;

use App\Manager\Facades\Package;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Relations\Relation;

class InventoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap(['good_variant' => 'Denmasyarikin\Inventory\Good\GoodVariant']);
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        Package::register('inventory', __DIR__, 'Denmasyarikin\Inventory');
    }
}
