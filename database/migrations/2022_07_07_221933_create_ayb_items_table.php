<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAybItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayb_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->string('description',100);
            $table->string('price',100);
            $table->bigInteger('sede_id')->nullable()->unsigned();
            $table->foreign('sede_id')->references('id')->on('sedes')->onUpdate('cascade');

            $table->bigInteger('group_menu_id')->nullable()->unsigned();
            $table->foreign('group_menu_id')->references('id')->on('group_menus')->onUpdate('cascade');

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
        Schema::dropIfExists('ayb_items');
    }
}
