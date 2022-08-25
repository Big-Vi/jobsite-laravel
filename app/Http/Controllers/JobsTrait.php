<?php

namespace App\Http\Controllers;
use App\Job;
use App\Jobalert;
use Illuminate\Support\Facades\Auth;

trait JobsTrait {
    public function reccommendedjob()
    {
        $reccommendedJobs = [];
        $jobseeker_id = Auth::user('jobseeker')->id;
        $jobalerts = Jobalert::where('jobseeker_id', $jobseeker_id)->first();
        if ($jobalerts != null) {
            $keywords = $jobalerts->keyword;
            if($jobalerts->category = null){
                $category = '';
            }
            if ($jobalerts-> subcategory = null) {
                $subcategory = '';
            }
            $category = $jobalerts->category;
            $subcategory = $jobalerts->subcategory;
            $location = $jobalerts->location;
            $jobs = Job::where('title', 'LIKE', "%{$keywords}%")
                ->where('category', 'LIKE', "%{$category}%")
                ->where('category', 'LIKE', "%{$subcategory}%")
                ->where('location', 'LIKE', "%{$location}%")
                ->get();
            array_push($reccommendedJobs, $jobs);
        }

        return $reccommendedJobs;
    }
}