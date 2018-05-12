<?php

namespace Denmasyarikin\Inventory\Good\database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Denmasyarikin\Inventory\Good\GoodVariant;
use Denmasyarikin\Inventory\Good\GoodVariantOption;

class GoodVariantTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        GoodVariant::create([
            'id' => 1,
            'name' => 'SIDU A4 70 GSM',
            'good_id' => 1,
            'unit_id' => 17,
            'tracked' => true,
            'on_hand' => 22,
            'on_hold' => 3,
            'ready_stock' => 19
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 1, 'good_option_item_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // merk sidu
            ['good_variant_id' => 1, 'good_option_item_id' => 6, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // A4
            ['good_variant_id' => 1, 'good_option_item_id' => 10, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // 70 gsm
        ]);

        GoodVariant::create([
            'id' => 2,
            'name' => 'SIDU A4 80 GSM',
            'good_id' => 1,
            'unit_id' => 17,
            'tracked' => true,
            'on_hand' => 14,
            'on_hold' => 1,
            'ready_stock' => 13
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 2, 'good_option_item_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // merk sidu
            ['good_variant_id' => 2, 'good_option_item_id' => 6, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // A4
            ['good_variant_id' => 2, 'good_option_item_id' => 11, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // 80 gsm
        ]);

        GoodVariant::create([
            'id' => 3,
            'name' => 'SIDU F4 70 GSM',
            'good_id' => 1,
            'unit_id' => 17
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 3, 'good_option_item_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // merk sidu
            ['good_variant_id' => 3, 'good_option_item_id' => 8, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // F4
            ['good_variant_id' => 3, 'good_option_item_id' => 10, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // 70 gsm
        ]);

        GoodVariant::create([
            'id' => 4,
            'name' => 'SIDU F4 80 GSM',
            'good_id' => 1,
            'unit_id' => 17,
            'tracked' => true,
            'on_hand' => 5,
            'on_hold' => 2,
            'ready_stock' => 3

        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 4, 'good_option_item_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // merk sidu
            ['good_variant_id' => 4, 'good_option_item_id' => 8, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // F4
            ['good_variant_id' => 4, 'good_option_item_id' => 11, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // 80 gsm
        ]);

        GoodVariant::create([
            'id' => 5,
            'name' => 'SIDU A3 70 GSM',
            'good_id' => 1,
            'unit_id' => 17
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 5, 'good_option_item_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // merk sidu
            ['good_variant_id' => 5, 'good_option_item_id' => 9, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // F4
            ['good_variant_id' => 5, 'good_option_item_id' => 10, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // 70 gsm
        ]);

        GoodVariant::create([
            'id' => 6,
            'name' => 'SIDU A3 80 GSM',
            'good_id' => 1,
            'unit_id' => 17
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 6, 'good_option_item_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // merk sidu
            ['good_variant_id' => 6, 'good_option_item_id' => 9, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // F4
            ['good_variant_id' => 6, 'good_option_item_id' => 11, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // 80 gsm
        ]);

        GoodVariant::create([
			'id' => 7,
			'name' => 'PAPERONE A4 70 GSM',
			'good_id' => 1,
            'unit_id' => 17
        ]);

        DB::table('inventory_good_variant_options')->insert([
        	['good_variant_id' => 7, 'good_option_item_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // merk paper one
        	['good_variant_id' => 7, 'good_option_item_id' => 6, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // A4
        	['good_variant_id' => 7, 'good_option_item_id' => 10, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // 70 gsm
        ]);

        GoodVariant::create([
			'id' => 8,
			'name' => 'PAPERONE A4 80 GSM',
			'good_id' => 1,
            'unit_id' => 17
        ]);

        DB::table('inventory_good_variant_options')->insert([
        	['good_variant_id' => 8, 'good_option_item_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // merk paper one
        	['good_variant_id' => 8, 'good_option_item_id' => 6, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // A4
        	['good_variant_id' => 8, 'good_option_item_id' => 11, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // 80 gsm
        ]);

        GoodVariant::create([
			'id' => 9,
			'name' => 'PAPERONE F4 70 GSM',
			'good_id' => 1,
            'unit_id' => 17
        ]);

        DB::table('inventory_good_variant_options')->insert([
        	['good_variant_id' => 9, 'good_option_item_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // merk paper one
        	['good_variant_id' => 9, 'good_option_item_id' => 8, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // F4
        	['good_variant_id' => 9, 'good_option_item_id' => 10, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // 70 gsm
        ]);

        GoodVariant::create([
            'id' => 10,
            'name' => 'PAPERONE F4 80 GSM',
            'good_id' => 1,
            'unit_id' => 17
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 10, 'good_option_item_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // merk paper one
            ['good_variant_id' => 10, 'good_option_item_id' => 8, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // F4
            ['good_variant_id' => 10, 'good_option_item_id' => 11, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // 80 gsm
        ]);

        GoodVariant::create([
            'id' => 11,
            'name' => 'PAPERONE A3 70 GSM',
            'good_id' => 1,
            'unit_id' => 17
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 11, 'good_option_item_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // merk paper one
            ['good_variant_id' => 11, 'good_option_item_id' => 9, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // F4
            ['good_variant_id' => 11, 'good_option_item_id' => 10, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // 70 gsm
        ]);

        GoodVariant::create([
			'id' => 12,
			'name' => 'PAPERONE A3 80 GSM',
			'good_id' => 1,
            'unit_id' => 17
        ]);

        DB::table('inventory_good_variant_options')->insert([
        	['good_variant_id' => 12, 'good_option_item_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // merk sidu
        	['good_variant_id' => 12, 'good_option_item_id' => 9, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // F4
        	['good_variant_id' => 12, 'good_option_item_id' => 11, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // 80 gsm
        ]);
    }
}
