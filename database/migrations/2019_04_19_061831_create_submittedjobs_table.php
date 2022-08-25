<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmittedjobsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('submittedjobs', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('jobseeker');
      $table->integer('jobseeker_id')->nullable();
      $table->integer('job_id')->nullable();
      $table->string('cv')->nullable();
      $table->string('coverletter')->nullable();
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
    Schema::dropIfExists('submittedjobs');
  }
}