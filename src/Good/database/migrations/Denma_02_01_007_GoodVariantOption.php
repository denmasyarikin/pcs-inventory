<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodVariantOption extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventory_good_variant_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_variant_id')->nullable()->default(null)->unsigned();
            $table->integer('good_option_item_id')->nullable()->default(null)->unsigned();
            $table->timestamps();

            $table->foreign('good_variant_id')->references('id')->on('inventory_good_variants');
            $table->foreign('good_option_item_id')->references('id')->on('inventory_good_option_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('inventory_good_variant_options');
    }
}
