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
        Schema::create('attlogs', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->string('employeeID',50);
            $table->dateTime('authDateTime',6)->nullable();
            $table->date('authDate')->nullable();
            $table->time('authTime',6)->nullable();
            $table->string('direction',50);
            $table->string('deviceName',50);
            $table->string('deviceSN',50);
            $table->string('personName',50);
            $table->string('cardNo',50);
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
