<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImgGlobalWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_global_warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->bigInteger('global_warehouse_id')->nullable()->unsigned();
            $table->foreign('global_warehouse_id')->references('id')->on('global_warehouses')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('img_global_warehouses');
    }
}
