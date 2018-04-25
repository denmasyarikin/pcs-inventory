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

        GoodOptionItem::create(['id' => 4, 'good_option_id' => 2, 'name' => 'A5', 'description' => '14,85cm x 21cm']);
        GoodOptionItem::create(['id' => 5, 'good_option_id' => 2, 'name' => 'B5', 'description' => '18.2cm x 25.7cm']);
        GoodOptionItem::create(['id' => 6, 'good_option_id' => 2, 'name' => 'A4', 'description' => '21cm x 29.7cm']);
        GoodOptionItem::create(['id' => 7, 'good_option_id' => 2, 'name' => 'Q4', 'description' => '21.6cm x 27.9cm']);
        GoodOptionItem::create(['id' => 8, 'good_option_id' => 2, 'name' => 'F4', 'description' => '21.6cm x 33cm']);
        GoodOptionItem::create(['id' => 9, 'good_option_id' => 2, 'name' => 'A3', 'description' => '29.7cm x 42cm']);
        
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
