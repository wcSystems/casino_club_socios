<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('password');
            $table->string('name',100);
            $table->bigInteger('level_id')->nullable()->unsigned();
            $table->foreign('level_id')->references('id')->on('levels')->onUpdate('cascade');
            $table->bigInteger('sede_id')->nullable()->unsigned();
            $table->foreign('sede_id')->references('id')->on('sedes')->onUpdate('cascade');
            $table->bigInteger('department_id')->nullable()->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade');
            $table->bigInteger('position_id')->nullable()->unsigned();
            $table->foreign('position_id')->references('id')->on('positions')->onUpdate('cascade');
            $table->bigInteger('sex_id')->nullable()->unsigned();
            $table->foreign('sex_id')->references('id')->on('sexs')->onUpdate('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
