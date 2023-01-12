<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employeeNo',100);
            $table->string('name',100);
            $table->string('nacimiento',100);
            $table->bigInteger('sex_id')->nullable()->unsigned();
            $table->foreign('sex_id')->references('id')->on('sexs')->onUpdate('cascade');
            $table->bigInteger('department_id')->nullable()->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade');
            $table->bigInteger('sede_id')->nullable()->unsigned();
            $table->foreign('sede_id')->references('id')->on('sedes')->onUpdate('cascade');
            $table->bigInteger('position_id')->nullable()->unsigned();
            $table->foreign('position_id')->references('id')->on('positions')->onUpdate('cascade');
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
        Schema::dropIfExists('employees');
    }
}
