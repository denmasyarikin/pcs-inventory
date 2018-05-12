<?php

namespace Denmasyarikin\Inventory\Good\database\seeds;

use Illuminate\Database\Seeder;
use Denmasyarikin\Inventory\Good\GoodOption;
use Denmasyarikin\Inventory\Good\GoodOptionItem;

class GoodOptionTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        GoodOption::create([
            'id' => 1,
            'good_id' => 1,
            'name' => 'Merk'
        ]);

        GoodOptionItem::create(['id' => 1, 'good_option_id' => 1, 'name' => 'Sinar Dunia']);
        GoodOptionItem::create(['id' => 2, 'good_option_id' => 1, 'name' => 'Paper One']);
        GoodOptionItem::create(['id' => 3, 'good_option_id' => 1, 'name' => 'Bola Dunia']);

        GoodOption::create([
            'id' => 2,
            'good_id' => 1,
            'name' => 'Ukuran'
        ]);

        GoodOptionItem::create(['id' => 4, 'good_option_id' => 2, 'name' => 'A5']);
        GoodOptionItem::create(['id' => 5, 'good_option_id' => 2, 'name' => 'B5']);
        GoodOptionItem::create(['id' => 6, 'good_option_id' => 2, 'name' => 'A4']);
        GoodOptionItem::create(['id' => 7, 'good_option_id' => 2, 'name' => 'Q4']);
        GoodOptionItem::create(['id' => 8, 'good_option_id' => 2, 'name' => 'F4']);
        GoodOptionItem::create(['id' => 9, 'good_option_id' => 2, 'name' => 'A3']);
        
        GoodOption::create([
            'id' => 3,
            'good_id' => 1,
            'name' => 'Berat'
        ]);

        GoodOptionItem::create(['id' => 10, 'good_option_id' => 3, 'name' => '70 gsm']);
        GoodOptionItem::create(['id' => 11, 'good_option_id' => 3, 'name' => '80 gsm']);
        GoodOptionItem::create(['id' => 12, 'good_option_id' => 3, 'name' => '100 gsm']);        
    }
}
