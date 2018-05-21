<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodCategoryWorkspace extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventory_good_category_workspaces', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workspace_id')->unsigned();
            $table->integer('good_category_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('workspace_id')->references('id')->on('core_workspaces');
            $table->foreign('good_category_id')->references('id')->on('inventory_good_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('inventory_good_category_workspaces');
    }
}
