<?php

namespace Denmasyarikin\Inventory;

use App\Manager\Facades\Package;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class InventoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        Package::register('inventory', __DIR__, 'Denmasyarikin\Inventory');
    }
}
