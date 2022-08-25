<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Job;

class DeactivateJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deactivatejobs';

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
        $jobs = Job::all();
        foreach ($jobs as $job) {
            $datePosted = $job->created_at;

            $dateFrom = new Carbon($datePosted);
            $dateEnd = Carbon::now();
            $daysJob = $dateFrom->diffInDays($dateEnd);

            if ($daysJob > 30) {
                $job->active = 0;
            }
            $job->save();
        }
    }
}