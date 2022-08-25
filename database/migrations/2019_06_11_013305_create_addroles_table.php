<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddrolesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('addroles', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->unsignedInteger('jobseeker_id')->nullable();
      $table->timestamps();
      $table->string('jobtitle')->nullable();
      $table->string('employer')->nullable();
      $table->string('description')->nullable();
      $table->date('startdate')->nullable();
      $table->date('enddate')->nullable();
      $table->boolean('stillinrole')->default(1);
      $table
        ->foreign('jobseeker_id')
        ->references('id')
        ->on('jobseekers')
        ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('addroles');
  }
}
