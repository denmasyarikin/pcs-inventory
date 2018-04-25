<?php

namespace Denmasyarikin\Inventory\Good\database\seeds;

use Illuminate\Database\Seeder;
use Denmasyarikin\Inventory\Good\GoodAttribute;

class GoodAttributeTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        GoodAttribute::create([
            'good_id' => 1,
            'type' => 'array',
            'key' => 'Ukuran',
            'value' => json_encode(['A5','B5','A4','Q4','F4','A3'])
        ]);

        GoodAttribute::create([
            'good_id' => 1,
            'type' => 'string',
            'key' => 'Warna',
            'value' => 'Putih'
        ]);

        GoodAttribute::create([
            'good_id' => 2,
            'type' => 'string',
            'key' => 'Ukuran',
            'value' => '1,2m x 1m'
        ]);

        GoodAttribute::create([
            'good_id' => 2,
            'type' => 'array',
            'key' => 'Warna',
            'value' => json_encode(['Putih', 'Merah', 'Biru', 'Hijau', 'Kuning'])
        ]);
    }
}
