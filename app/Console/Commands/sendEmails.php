<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Job;
use App\Jobseeker;
use App\Jobalert;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobAlertEmailNotification;

class sendEmails extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'command:sendjobalertemails';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Command description';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    $jobseekers = Jobseeker::all();
    foreach ($jobseekers as $jobseeker) {
      $jobalert = Jobalert::where('jobseeker_id', $jobseeker->id)->first();
      if ($jobalert != null) {
        $keywords = $jobalert->keyword;
        $category = $jobalert->category;
        $location = $jobalert->location;
        $jobs = Job::where('title', 'LIKE', "%{$keywords}%")
          ->where('category', 'LIKE', "%{$category}%")
          ->where('location', 'LIKE', "%{$location}%")
          ->get();
        Mail::to($jobseeker->email)->send(new JobAlertEmailNotification($jobs));
      }
    }
  }
}
