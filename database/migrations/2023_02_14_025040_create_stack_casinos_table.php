<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStackCasinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stack_casinos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('cantidad',100);
            
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
        Schema::dropIfExists('stack_casinos');
    }
}
