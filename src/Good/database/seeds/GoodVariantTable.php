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
            'name' => 'SIDU HVS A4 70 GSM',
            'good_id' => 1
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 1, 'good_option_item_id' => 1], // merk sidu
            ['good_variant_id' => 1, 'good_option_item_id' => 6], // A4
            ['good_variant_id' => 1, 'good_option_item_id' => 10], // 70 gsm
        ]);

        GoodVariant::create([
            'id' => 2,
            'name' => 'SIDU HVS A4 80 GSM',
            'good_id' => 1
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 2, 'good_option_item_id' => 1], // merk sidu
            ['good_variant_id' => 2, 'good_option_item_id' => 6], // A4
            ['good_variant_id' => 2, 'good_option_item_id' => 11], // 80 gsm
        ]);

        GoodVariant::create([
            'id' => 3,
            'name' => 'SIDU HVS F4 70 GSM',
            'good_id' => 1
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 3, 'good_option_item_id' => 1], // merk sidu
            ['good_variant_id' => 3, 'good_option_item_id' => 8], // F4
            ['good_variant_id' => 3, 'good_option_item_id' => 10], // 70 gsm
        ]);

        GoodVariant::create([
            'id' => 4,
            'name' => 'SIDU HVS F4 80 GSM',
            'good_id' => 1
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 4, 'good_option_item_id' => 1], // merk sidu
            ['good_variant_id' => 4, 'good_option_item_id' => 8], // F4
            ['good_variant_id' => 4, 'good_option_item_id' => 11], // 80 gsm
        ]);

        GoodVariant::create([
            'id' => 5,
            'name' => 'SIDU HVS A3 70 GSM',
            'good_id' => 1
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 5, 'good_option_item_id' => 1], // merk sidu
            ['good_variant_id' => 5, 'good_option_item_id' => 9], // F4
            ['good_variant_id' => 5, 'good_option_item_id' => 10], // 70 gsm
        ]);

        GoodVariant::create([
            'id' => 6,
            'name' => 'SIDU HVS A3 80 GSM',
            'good_id' => 1
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 6, 'good_option_item_id' => 1], // merk sidu
            ['good_variant_id' => 6, 'good_option_item_id' => 9], // F4
            ['good_variant_id' => 6, 'good_option_item_id' => 11], // 80 gsm
        ]);

        //============= PAPERONE

        GoodVariant::create([
			'id' => 7,
			'name' => 'PAPERONE HVS A4 70 GSM',
			'good_id' => 1
        ]);

        DB::table('inventory_good_variant_options')->insert([
        	['good_variant_id' => 7, 'good_option_item_id' => 2], // merk paper one
        	['good_variant_id' => 7, 'good_option_item_id' => 6], // A4
        	['good_variant_id' => 7, 'good_option_item_id' => 10], // 70 gsm
        ]);

        GoodVariant::create([
			'id' => 8,
			'name' => 'PAPERONE HVS A4 80 GSM',
			'good_id' => 1
        ]);

        DB::table('inventory_good_variant_options')->insert([
        	['good_variant_id' => 8, 'good_option_item_id' => 2], // merk paper one
        	['good_variant_id' => 8, 'good_option_item_id' => 6], // A4
        	['good_variant_id' => 8, 'good_option_item_id' => 11], // 80 gsm
        ]);

        GoodVariant::create([
			'id' => 9,
			'name' => 'PAPERONE HVS F4 70 GSM',
			'good_id' => 1
        ]);

        DB::table('inventory_good_variant_options')->insert([
        	['good_variant_id' => 9, 'good_option_item_id' => 2], // merk paper one
        	['good_variant_id' => 9, 'good_option_item_id' => 8], // F4
        	['good_variant_id' => 9, 'good_option_item_id' => 10], // 70 gsm
        ]);

        GoodVariant::create([
            'id' => 10,
            'name' => 'PAPERONE HVS F4 80 GSM',
            'good_id' => 1
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 10, 'good_option_item_id' => 2], // merk paper one
            ['good_variant_id' => 10, 'good_option_item_id' => 8], // F4
            ['good_variant_id' => 10, 'good_option_item_id' => 11], // 80 gsm
        ]);

        GoodVariant::create([
            'id' => 11,
            'name' => 'PAPERONE HVS A3 70 GSM',
            'good_id' => 1
        ]);

        DB::table('inventory_good_variant_options')->insert([
            ['good_variant_id' => 11, 'good_option_item_id' => 2], // merk paper one
            ['good_variant_id' => 11, 'good_option_item_id' => 9], // F4
            ['good_variant_id' => 11, 'good_option_item_id' => 10], // 70 gsm
        ]);

        GoodVariant::create([
			'id' => 12,
			'name' => 'PAPERONE HVS A3 80 GSM',
			'good_id' => 1
        ]);

        DB::table('inventory_good_variant_options')->insert([
        	['good_variant_id' => 12, 'good_option_item_id' => 2], // merk sidu
        	['good_variant_id' => 12, 'good_option_item_id' => 9], // F4
        	['good_variant_id' => 12, 'good_option_item_id' => 11], // 80 gsm
        ]);
    }
}