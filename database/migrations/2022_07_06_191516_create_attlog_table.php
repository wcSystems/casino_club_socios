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
            $table->bigIncrements('id');
            $table->string('serialNo',50);
            $table->string('name',50);
            $table->string('time',50);
            $table->string('employeeNoString',50);
            $table->string('pictureURL',200);
            $table->string('facePictureUser',200);
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
        Schema::dropIfExists('attlogs');
    }
}
