<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociatedMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associated_machines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);

            $table->bigInteger('associated_group_id')->nullable()->unsigned();
            $table->foreign('associated_group_id')->references('id')->on('associated_groups')->onUpdate('cascade');

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
        Schema::dropIfExists('associated_machines');
    }
}
