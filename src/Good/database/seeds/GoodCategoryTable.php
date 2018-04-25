<?php

namespace Denmasyarikin\Inventory\Good\database\seeds;

use Illuminate\Database\Seeder;
use Denmasyarikin\Inventory\Good\GoodCategory;

class GoodCategoryTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        GoodCategory::create([
            'id' => 1,
            'name' => 'Kertas',
            'description' => 'Untuk keperluan bisnis perkantoran atau lainnya',
            'image' => null,
            'parent_id' => null,
        ]);

        GoodCategory::create([
            'id' => 2,
            'name' => 'Blanko Undangan',
            'description' => 'Untuk keperluan bisnis perkantoran atau lainnya',
            'image' => null,
            'parent_id' => null,
        ]);
    }
}
