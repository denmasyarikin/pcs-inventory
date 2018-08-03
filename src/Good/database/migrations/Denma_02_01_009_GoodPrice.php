<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodPrice extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventory_good_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_variant_id')->unsigned();
            $table->integer('chanel_id')->nullable()->default(null)->unsigned()->comment('where chanel_id is null that mean is base price');
            $table->float('price');
            $table->boolean('current')->default(true);
            $table->integer('previous_id')->unsigned()->nullable()->default(null);
            $table->enum('change_type', ['up', 'down'])->nullable()->default(null);
            $table->float('difference');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('good_variant_id')->references('id')->on('inventory_good_variants');
            $table->foreign('previous_id')->references('id')->on('inventory_good_prices');
            $table->foreign('chanel_id')->references('id')->on('core_chanels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('inventory_good_prices');
    }
}
