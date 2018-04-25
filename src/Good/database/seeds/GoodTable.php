<?php

namespace Denmasyarikin\Inventory\Good\database\seeds;

use Illuminate\Database\Seeder;
use Denmasyarikin\Inventory\Good\Good;

class GoodTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Good::create([
            'id' => 1,
            'name' => 'HVS',
            'description' => 'Kertas Untuk keperluan bisnis perkantoran atau lainnya',
            'good_category_id' => 1,
            'enabled' => true
        ]);

        Good::create([
            'id' => 2,
            'name' => 'Karton',
            'description' => 'Kertas untuk mencetak dan lain lain',
            'good_category_id' => 1,
            'enabled' => true
        ]);

        Good::create([
            'id' => 3,
            'name' => 'Era Baru',
            'description' => 'Blanko udangan untuk pernikahan dan lain nya',
            'good_category_id' => 2,
            'enabled' => true
        ]);

        Good::create([
            'id' => 4,
            'name' => 'Pelastik Undangan',
            'description' => 'Plastik untuk undangan blanko atau undagnan cetak',
            'good_category_id' => null,
            'enabled' => true
        ]);
    }
}
