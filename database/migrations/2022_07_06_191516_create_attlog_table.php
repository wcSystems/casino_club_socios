<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attlog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employeeID',50);
            $table->dateTime('authDateTime')->nullable();
            $table->date('authDate')->nullable();
            $table->time('authTime')->nullable();
            $table->string('direction',50);
            $table->string('deviceName',50);
            $table->string('deviceSN',50);
            $table->string('personName',50);
            $table->string('cardNo',50);
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
        Schema::dropIfExists('attlog');
    }
}
