<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConteoDropCecomCasinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conteo_drop_cecom_casinos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cantidad',100);
            $table->bigInteger('group_drops_casino_id')->nullable()->unsigned();
            $table->foreign('group_drops_casino_id')->references('id')->on('group_drops_casinos')->onUpdate('cascade');

            $table->bigInteger('mesas_casino_id')->nullable()->unsigned();
            $table->foreign('mesas_casino_id')->references('id')->on('mesas_casinos')->onUpdate('cascade');

            $table->bigInteger('billetes_casino_id')->nullable()->unsigned();
            $table->foreign('billetes_casino_id')->references('id')->on('billetes_casinos')->onUpdate('cascade');

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
        Schema::dropIfExists('conteo_drop_cecom_casinos');
    }
}
