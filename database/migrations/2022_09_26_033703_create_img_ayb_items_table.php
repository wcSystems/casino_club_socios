<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImgAybItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_ayb_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->bigInteger('ayb_item_id')->nullable()->unsigned();
            $table->foreign('ayb_item_id')->references('id')->on('ayb_items')->onUpdate('cascade');

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
        Schema::dropIfExists('img_ayb_items');
    }
}
