<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_templates', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('employee_id')->nullable()->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade');

            $table->bigInteger('year_month_group_id')->nullable()->unsigned();
            $table->foreign('year_month_group_id')->references('id')->on('year_month_groups')->onUpdate('cascade');

            $table->text('horario');
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
        Schema::dropIfExists('schedule_templates');
    }
}
