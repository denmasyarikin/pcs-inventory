<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Good extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventory_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->text('description');
            $table->integer('good_category_id')->nullable()->default(null)->unsigned();
            $table->boolean('enabled')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('good_category_id')->references('id')->on('inventory_good_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('inventory_goods');
    }
}
