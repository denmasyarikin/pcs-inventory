<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodAttribute extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventory_good_attributs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_id')->nullable()->default(null)->unsigned();
            $table->string('key', 50);
            $table->text('value');
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
        Schema::dropIfExists('inventory_good_attributs');
    }
}
