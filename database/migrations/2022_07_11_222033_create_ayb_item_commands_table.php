<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAybItemCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayb_item_commands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ayb_item_id')->nullable()->unsigned();
            $table->foreign('ayb_item_id')->references('id')->on('ayb_items')->onUpdate('cascade');
            $table->bigInteger('ayb_command_id')->nullable()->unsigned();
            $table->foreign('ayb_command_id')->references('id')->on('ayb_commands')->onUpdate('cascade');
            $table->string('total',11);
            $table->string('option',11);
            $table->string('game',11);
            $table->string('aprobado',50);
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
        Schema::dropIfExists('ayb_item_commands');
    }
}
