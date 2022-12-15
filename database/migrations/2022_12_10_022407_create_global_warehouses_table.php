<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serial',100);
            $table->bigInteger('associated_machine_id')->nullable()->unsigned();
            $table->foreign('associated_machine_id')->references('id')->on('associated_machines')->onUpdate('cascade');
            $table->bigInteger('brand_machine_id')->nullable()->unsigned();
            $table->foreign('brand_machine_id')->references('id')->on('brand_machines')->onUpdate('cascade');
            $table->bigInteger('model_machine_id')->nullable()->unsigned();
            $table->foreign('model_machine_id')->references('id')->on('model_machines')->onUpdate('cascade');
            $table->boolean('condicion')->default(0);
            $table->bigInteger('room_id')->nullable()->unsigned();
            $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('cascade');
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
        Schema::dropIfExists('global_warehouses');
    }
}
