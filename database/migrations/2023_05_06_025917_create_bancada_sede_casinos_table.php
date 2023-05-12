<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBancadaSedeCasinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bancada_sede_casinos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('cantidad',100);

            $table->bigInteger('fichas_casino_id')->nullable()->unsigned();
            $table->foreign('fichas_casino_id')->references('id')->on('fichas_casinos')->onUpdate('cascade');

            $table->bigInteger('sede_id')->nullable()->unsigned();
            $table->foreign('sede_id')->references('id')->on('sedes')->onUpdate('cascade');
            
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
        Schema::dropIfExists('bancada_sede_casinos');
    }
}
