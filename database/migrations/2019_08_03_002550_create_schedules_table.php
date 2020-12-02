<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->integer('start_time')->nullable();
            $table->integer('end_time')->nullable();
            $table->boolean('mon')->nullable();
            $table->boolean('tues')->nullable();
            $table->boolean('wed')->nullable();
            $table->boolean('thurs')->nullable();
            $table->boolean('fri')->nullable();
            $table->boolean('sat')->nullable();
            $table->boolean('sun')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
