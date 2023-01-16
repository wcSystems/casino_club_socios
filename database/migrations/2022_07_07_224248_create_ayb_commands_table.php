<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAybCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayb_commands', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('type_command_id')->nullable()->unsigned();
            $table->foreign('type_command_id')->references('id')->on('type_commands')->onUpdate('cascade');

            $table->bigInteger('employee_id')->nullable()->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade');
            
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
        Schema::dropIfExists('ayb_commands');
    }
}
