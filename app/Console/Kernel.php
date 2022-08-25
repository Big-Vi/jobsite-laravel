<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
  /**
   * The Artisan commands provided by your application.
   *
   * @var array
   */
  protected $commands = [
  Commands\sendEmails::class,
  Commands\DeactivateJobs::class,
  ];

  /**
   * Define the application's command schedule.
   *
   * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
   * @return void
   */
  protected function schedule(Schedule $schedule)
  {
    $schedule
      ->command('command:sendjobalertemails')
      ->dailyAt('11:16')
      ->timezone('Pacific/Auckland');
    $schedule
      ->command('command:deactivatejobs')
      ->dailyAt('19:20')
      ->timezone('Pacific/Auckland');
  }

  /**
   * Register the commands for the application.
   *
   * @return void
   */
  protected function commands()
  {
    $this->load(__DIR__ . '/Commands');

    require base_path('routes/console.php');
  }
}