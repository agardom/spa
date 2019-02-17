<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('services_timetables', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('serviceId')->references('id')->on('services');
          $table->date('date');
          $table->time('start');
          $table->time('end');
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
      Schema::dropIfExists('services_timetables');
    }
}
