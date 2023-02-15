<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConteoArchingsCecomCasinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conteo_archings_cecom_casinos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cantidad',100);
            $table->bigInteger('group_archings_casino_id')->nullable()->unsigned();
            $table->foreign('group_archings_casino_id')->references('id')->on('group_archings_casinos')->onUpdate('cascade');

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
        Schema::dropIfExists('conteo_archings_cecom_casinos');
    }
}
