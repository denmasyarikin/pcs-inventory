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
        GoodPrice::create(['good_variant_id' => 1, 'price' => 35000]);
        GoodPrice::create(['good_variant_id' => 2, 'price' => 49000]);
        GoodPrice::create(['good_variant_id' => 3, 'price' => 30000]);
        GoodPrice::create(['good_variant_id' => 4, 'price' => 39000]);
        GoodPrice::create(['good_variant_id' => 5, 'price' => 35000]);
        GoodPrice::create(['good_variant_id' => 6, 'price' => 49000]);
        GoodPrice::create(['good_variant_id' => 7, 'price' => 30000]);
        GoodPrice::create(['good_variant_id' => 8, 'price' => 39000]);
        GoodPrice::create(['good_variant_id' => 9, 'price' => 35000]);
        GoodPrice::create(['good_variant_id' => 10, 'price' => 49000]);
        GoodPrice::create(['good_variant_id' => 11, 'price' => 30000]);
        GoodPrice::create(['good_variant_id' => 12, 'price' => 39000]);
    }
}
