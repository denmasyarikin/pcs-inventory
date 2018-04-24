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
            $table->string('name', 50);
            $table->string('specific', 50)->nullable()->default(null);
            $table->integer('good_id')->unsigned();
            $table->boolean('tracked')->default(false);
            $table->boolean('enabled')->default(true);
            $table->bigInteger('on_hold');
            $table->bigInteger('on_hand');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('good_id')->references('id')->on('inventory_goods');
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
