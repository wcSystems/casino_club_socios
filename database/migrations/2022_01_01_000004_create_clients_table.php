<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100)->nullable();
            $table->string('last_name',100)->nullable();
            $table->string('cedula',12)->nullable();
            $table->date('f_nac')->nullable();
            $table->string('email')->nullable();
            $table->string('address',100)->nullable();
            $table->string('phone',12)->nullable();
            $table->boolean('club_vip')->default(0);
            $table->boolean('referido')->default(0);
            $table->boolean('vive_cerca')->default(0);
            $table->boolean('trabaja_cerca')->default(0);
            $table->boolean('solo_de_paso')->default(0);
            $table->boolean('descuento')->default(0);
            $table->boolean('puntos_por_canje')->default(0);
            $table->boolean('ticket_souvenirs')->default(0);
            $table->bigInteger('transportation_id')->nullable()->unsigned();
            $table->foreign('transportation_id')->references('id')->on('transportations')->onUpdate('cascade');
            $table->boolean('group')->default(1);
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
        Schema::dropIfExists('clients');
    }
}
