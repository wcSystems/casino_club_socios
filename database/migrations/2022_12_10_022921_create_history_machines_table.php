<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_machines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('global_warehouse_id')->nullable()->unsigned();
            $table->foreign('global_warehouse_id')->references('id')->on('global_warehouses')->onUpdate('cascade');
            $table->bigInteger('novedades_type_id')->nullable()->unsigned();
            $table->foreign('novedades_type_id')->references('id')->on('novedades_types')->onUpdate('cascade');
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
        Schema::dropIfExists('history_machines');
    }
}
