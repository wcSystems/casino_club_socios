<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperacionesMesasCasinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operaciones_mesas_casinos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('group_cierre_boveda_casino_id')->nullable()->unsigned();
            $table->foreign('group_cierre_boveda_casino_id')->references('id')->on('group_cierre_boveda_casinos')->onUpdate('cascade');

            $table->bigInteger('mesas_casino_id')->nullable()->unsigned();
            $table->foreign('mesas_casino_id')->references('id')->on('mesas_casinos')->onUpdate('cascade');
            $table->bigInteger('fichas_casino_id')->nullable()->unsigned();
            $table->foreign('fichas_casino_id')->references('id')->on('fichas_casinos')->onUpdate('cascade');
            $table->bigInteger('billetes_casino_id')->nullable()->unsigned();
            $table->foreign('billetes_casino_id')->references('id')->on('billetes_casinos')->onUpdate('cascade');

            $table->string('tipo',100)->nullable();
            $table->string('cantidad',100)->nullable();

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
        Schema::dropIfExists('operaciones_mesas_casinos');
    }
}
