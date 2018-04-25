<?php

namespace Denmasyarikin\Inventory\Good\database\seeds;

use Illuminate\Database\Seeder;
use Denmasyarikin\Inventory\Good\GoodPrice;

class GoodPriceTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        GoodPrice::create(['good_variant_id' => 1, 'unit_id' => 17, 'price' => 35000]);
        GoodPrice::create(['good_variant_id' => 2, 'unit_id' => 17, 'price' => 49000]);
        GoodPrice::create(['good_variant_id' => 3, 'unit_id' => 17, 'price' => 30000]);
        GoodPrice::create(['good_variant_id' => 4, 'unit_id' => 17, 'price' => 39000]);
        GoodPrice::create(['good_variant_id' => 5, 'unit_id' => 17, 'price' => 35000]);
        GoodPrice::create(['good_variant_id' => 6, 'unit_id' => 17, 'price' => 49000]);
        GoodPrice::create(['good_variant_id' => 7, 'unit_id' => 17, 'price' => 30000]);
        GoodPrice::create(['good_variant_id' => 8, 'unit_id' => 17, 'price' => 39000]);
        GoodPrice::create(['good_variant_id' => 9, 'unit_id' => 17, 'price' => 35000]);
        GoodPrice::create(['good_variant_id' => 10, 'unit_id' => 17, 'price' => 49000]);
        GoodPrice::create(['good_variant_id' => 11, 'unit_id' => 17, 'price' => 30000]);
        GoodPrice::create(['good_variant_id' => 12, 'unit_id' => 17, 'price' => 39000]);
    }
}
