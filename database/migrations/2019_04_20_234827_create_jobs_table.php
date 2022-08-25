<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('jobs')) {
      Schema::create('jobs', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->boolean('active');
        $table->unsignedInteger('employer_id')->nullable();
        $table
          ->integer('jobseeker_id')
          ->unsigned()
          ->nullable();
        $table->string('title');
        $table->longText('description');
        $table->longText('pitch')->nullable();
        $table->string('location')->nullable();
        $table->string('worktype')->nullable();
        $table->unsignedMediumInteger('payrange')->nullable();
        $table->string('logo')->nullable();
        $table->string('category');
        $table->unsignedMediumInteger('categoryindex')->nullable();
        $table->unsignedMediumInteger('subcategoryindex')->nullable();
        $table->string('subcategory');
        $table->timestamps();
        $table
          ->foreign('employer_id')
          ->references('id')
          ->on('employers')
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
    Schema::dropIfExists('jobs');
  }
}