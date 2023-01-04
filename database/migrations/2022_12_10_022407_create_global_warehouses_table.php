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
            $table->bigInteger('condicion_group_id')->nullable()->unsigned();
            $table->foreign('condicion_group_id')->references('id')->on('condicion_groups')->onUpdate('cascade');
            $table->bigInteger('room_id')->nullable()->unsigned();
            $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('cascade');


            $table->string('name_machine_room_active',100)->nullable();
            $table->bigInteger('value_machine_id')->nullable()->unsigned();
            $table->foreign('value_machine_id')->references('id')->on('value_machines')->onUpdate('cascade');
            $table->bigInteger('play_machine_id')->nullable()->unsigned();
            $table->foreign('play_machine_id')->references('id')->on('play_machines')->onUpdate('cascade');
            $table->bigInteger('range_machine_id')->nullable()->unsigned();
            $table->foreign('range_machine_id')->references('id')->on('range_machines')->onUpdate('cascade');

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
