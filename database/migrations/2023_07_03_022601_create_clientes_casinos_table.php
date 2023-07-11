<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesCasinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_casinos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100)->nullable();
            $table->string('description',100)->nullable();
            $table->bigInteger('sede_id')->nullable()->unsigned();
            $table->foreign('sede_id')->references('id')->on('sedes')->onUpdate('cascade');
            $table->bigInteger('clasificacion_cliente_casino_id')->nullable()->unsigned();
            $table->foreign('clasificacion_cliente_casino_id')->references('id')->on('clasificacion_cliente_casinos')->onUpdate('cascade');
            $table->bigInteger('sex_id')->nullable()->unsigned();
            $table->foreign('sex_id')->references('id')->on('sexs')->onUpdate('cascade');
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
        Schema::dropIfExists('clientes_casinos');
    }
}
