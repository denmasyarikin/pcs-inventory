
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
        Schema::create('inventory_good_priceses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_variant_id')->nullable()->default(null)->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->integer('chanel_id')->nullable()->default(null)->unsigned();
            $table->bigInteger('price');
            $table->boolean('current');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('good_variant_id')->references('id')->on('inventory_good_variants');
            $table->foreign('unit_id')->references('id')->on('core_units');
            $table->foreign('chanel_id')->references('id')->on('core_chanels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('inventory_good_priceses');
    }
}