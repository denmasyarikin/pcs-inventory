<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodVariantMedia extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventory_good_variant_medias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_variant_id')->unsigned();
            $table->enum('type', ['image', 'youtube'])->default('image');
            $table->text('content');
            $table->integer('sequence')->default(0);
            $table->boolean('primary')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('good_variant_id')->references('id')->on('inventory_good_variants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('inventory_good_variant_medias');
    }
}
