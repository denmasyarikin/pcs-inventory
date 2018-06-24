<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodVariant extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventory_good_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->nullable()->default(null);
            $table->integer('good_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->boolean('tracked')->default(false);
            $table->boolean('enabled')->default(false);
            $table->bigInteger('on_hold')->default(0);
            $table->bigInteger('on_hand')->default(0);
            $table->bigInteger('ready_stock')->comment('on hand minus on hold')->default(0);
            $table->float('min_order')->default(1);
            $table->float('order_multiples')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('good_id')->references('id')->on('inventory_goods');
            $table->foreign('unit_id')->references('id')->on('core_units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('inventory_good_variants');
    }
}
