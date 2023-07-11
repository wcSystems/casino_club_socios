<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupCierreBovedasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_cierre_bovedas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('extra',100)->nullable();
            $table->bigInteger('sede_id')->nullable()->unsigned();
            $table->foreign('sede_id')->references('id')->on('sedes')->onUpdate('cascade');
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
        Schema::dropIfExists('group_cierre_bovedas');
    }
}
