<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodOptionItem extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventory_good_option_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->integer('good_option_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('good_option_id')->references('id')->on('inventory_good_options');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('inventory_good_option_items');
    }
}
