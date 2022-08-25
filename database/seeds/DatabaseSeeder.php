<?php

use Illuminate\Database\Seeder;
use App\Job;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // $this->call(UsersTableSeeder::class);
    factory(App\Job::class, 10)->create();
  }
}
