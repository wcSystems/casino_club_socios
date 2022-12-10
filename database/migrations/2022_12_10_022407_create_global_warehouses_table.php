<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->string('description',100);
            $table->string('cod',100);
            $table->bigInteger('shed_id')->nullable()->unsigned();
            $table->foreign('shed_id')->references('id')->on('sheds')->onUpdate('cascade');
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
        Schema::dropIfExists('global_warehouses');
    }
}
