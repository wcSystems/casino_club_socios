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
        Schema::dropIfExists('history_machines');
    }
}
