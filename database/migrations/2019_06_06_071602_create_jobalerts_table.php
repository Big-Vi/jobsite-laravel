<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobalertsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('jobalerts')) {
      Schema::create('jobalerts', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->unsignedInteger('jobseeker_id')->nullable();
        $table->timestamps();
        $table->string('keyword')->nullable();
        $table->string('category')->nullable();
        $table->string('subcategory')->nullable();
        $table->string('categoryindex')->nullable();
        $table->string('subcategoryindex')->nullable();
        $table->string('location')->nullable();
        $table
          ->foreign('jobseeker_id')
          ->references('id')
          ->on('jobseekers')
          ->onDelete('cascade');
      });
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('jobalerts');
  }
}