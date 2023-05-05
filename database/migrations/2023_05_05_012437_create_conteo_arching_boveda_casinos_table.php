<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConteoArchingBovedaCasinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conteo_arching_boveda_casinos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cantidad',100);
            $table->bigInteger('group_cierre_boveda_id')->nullable()->unsigned();
            $table->foreign('group_cierre_boveda_id')->references('id')->on('group_cierre_bovedas')->onUpdate('cascade');

            $table->bigInteger('mesas_casino_id')->nullable()->unsigned();
            $table->foreign('mesas_casino_id')->references('id')->on('mesas_casinos')->onUpdate('cascade');

            $table->bigInteger('fichas_casino_id')->nullable()->unsigned();
            $table->foreign('fichas_casino_id')->references('id')->on('fichas_casinos')->onUpdate('cascade');
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
        Schema::dropIfExists('conteo_arching_boveda_casinos');
    }
}
