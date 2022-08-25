<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Jobseeker;
use App\Employer;
use App\Jobalert;
use App\Addrole;
use App\Favorite;
use Carbon\Carbon;
use App\Submittedjob;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Mail\JobSubmittedEmailNotificationForEmployer;
use App\Mail\JobSubmittedEmailNotificationForJobseeker;
use App\Mail\SendJobEmailNotification;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\JobsTrait;

class JobseekerJobController extends Controller
{
  use JobsTrait;
  public function __construct()
  {
    $this->middleware('auth:jobseeker', ['except' => ['showJob']]);
  }
  public function showJob($id)
  {
    $job = Job::find($id);
    
    return view('jobseeker.showjob', compact('job'));
  }
  public function showapplyJob($id)
  {
    $jobseeker = Jobseeker::find(Auth::user('jobseeker')->id);
    $role = Addrole::all()->first();
    if ($role) {
      $role = Addrole::where('stillinrole', '=', '1')->first();
      if ($role) {
        $dateF = $role->startdate;
        $dateFrom = new Carbon($dateF);
        $dateE = $role->enddate;
        $dateEnd = Carbon::now();
        $monthInJob = $dateFrom->diffInMonths($dateEnd);
      } else {
        $role = Addrole::where('stillinrole', '=', '0')
          ->orderBy('enddate', 'DESC')
          ->first();
        $dateF = $role->startdate;
        $dateFrom = new Carbon($dateF);
        $dateE = $role->enddate;
        $dateEnd = new Carbon($dateE);
        $monthInJob = $dateFrom->diffInMonths($dateEnd);
      }
    } else {
      $role = [];
    }

    $job = Job::find($id);
    return view('jobseeker.applyjob', compact('job', 'jobseeker', 'role', 'monthInJob'));
  }
  public function applyJob(Request $request)
  {
    $attributes = request()->validate([
      'jobseeker' => 'required',
      'jobseeker_id' => 'required',
      'job_id' => 'required',
      'cv' => 'mimes:pdf|nullable|max:1999',
      'coverletter' => 'mimes:pdf|nullable|max:1999'
    ]);
    $job_id = Input::get('job_id');
    $job = Job::find($job_id);
    $employer_id = $job->employer_id;
    $employer = Employer::find($employer_id);
    //handle file upload
    if ($request->hasFile('cv')) {
      //Get filename with the extension
      $filenameWithExt = $request->file('cv')->getClientOriginalName();
      // Get just filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      //Get jobseeker user name
      $jobseekername = Input::get('jobseeker');
      // Get just ext
      $extension = $request->file('cv')->getClientOriginalExtension();
      //Filename to store
      $cvfileNameToStore = str_replace(' ', '-', $jobseekername) . '_CV' . '_' . time() . '.' . $extension;
      //upload image
      $empname = str_replace(' ', '-', $employer->name);
      $jobtitle = str_replace(' ', '-', $job->title);
      $path = $request
        ->file('cv')
        ->storeAs(
          "public/jobs/$empname/$jobtitle/submitted-applications",$cvfileNameToStore);
}
if ($request->hasFile('coverletter')) {
//Get filename with the extension
$filenameWithExt = $request->file('coverletter')->getClientOriginalName();
// Get just filename
$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
//Get jobseeker user name
$jobseekername = Input::get('jobseeker');
// Get just ext
$extension = $request->file('coverletter')->getClientOriginalExtension();
//Filename to store
$clfileNameToStore = str_replace(' ', '-', $jobseekername) . '_CoverLetter' . '_' . time() . '.' . $extension;
      //upload image
      $empname = str_replace(' ', '-', $employer->name);
      $jobtitle = str_replace(' ', '-', $job->title);
$path = $request
->file('coverletter')
        ->storeAs(
          "public/jobs/$empname/$jobtitle/submitted-applications",
          $clfileNameToStore
        );
}
$submittedjob = Submittedjob::create($attributes);
$submittedjob->cv = $cvfileNameToStore;
$submittedjob->coverletter = $clfileNameToStore;
$submittedjob->save();
$jobseeker = Jobseeker::find(Auth::user('jobseeker')->id);
Mail::to($jobseeker->email)->send(new JobSubmittedEmailNotificationForJobseeker($submittedjob));
Mail::to($employer->email)->send(new JobSubmittedEmailNotificationForEmployer($submittedjob));
return redirect('/jobseeker');
}
public function showJobalert()
{
return view('jobseeker.showjobalert');
}
public function storeJobalert(Request $request)
{
$attributes = request()->validate([
'keyword' => 'required',
'category' => 'nullable',
'subcategory' => 'nullable',
'categoryindex' => 'nullable',
'subcategoryindex' => 'nullable',
'location' => 'nullable'
]);
$jobseeker_id = Auth::user('jobseeker')->id;
$jobseeker = Jobseeker::find($jobseeker_id);
$jobalert = Jobalert::create($attributes);
$jobseeker->jobalerts()->save($jobalert);
$jobalerts = Jobalert::where('jobseeker_id', $jobseeker_id)->first();
$submittedjobs = Submittedjob::where('jobseeker_id', $jobseeker_id)->get();
$appliedjob = [];
if ($submittedjobs->count()) {
foreach ($submittedjobs as $item) {
$job_id = $item->job_id;
$jobs = Job::find($job_id);
array_push($appliedjob, $jobs);
}
}
$reccommendedJobs = $this->reccommendedjob();
return view('jobseeker.index', compact('jobalerts', 'reccommendedJobs', 'appliedjob'));

}
public function editJobalert($id)
{
$jobalert = Jobalert::find($id);
return view('jobseeker.editjobalert', compact('jobalert'));
}
public function updateJobalert($id)
{
$jobalert = Jobalert::findOrFail($id);
$jobalert->category = request('category');
$jobalert->subcategory = request('subcategory');
$jobalert->categoryindex = request('categoryindex');
$jobalert->subcategoryindex = request('subcategoryindex');
$jobalert->location = request('location');
$jobalert->keyword = request('keyword');
$jobseeker_id = Auth::user('jobseeker')->id;
$jobseeker = Jobseeker::find($jobseeker_id);
$jobalert->save();
$jobalerts = Jobalert::where('jobseeker_id', $jobseeker_id)->first();
$submittedjobs = Submittedjob::where('jobseeker_id', $jobseeker_id)->get();
$appliedjob = [];
if ($submittedjobs->count()) {
foreach ($submittedjobs as $item) {
$job_id = $item->job_id;
$jobs = Job::find($job_id);
array_push($appliedjob, $jobs);
}
}
$reccommendedJobs = $this->reccommendedjob();

return view('jobseeker.index', compact('jobalerts', 'reccommendedJobs', 'appliedjob'));

}
public function deleteJobalert($id)
{
$jobalert = Jobalert::findOrFail($id);
$jobseeker_id = Auth::user('jobseeker')->id;
$jobalert->delete();
$jobalerts = Jobalert::where('jobseeker_id', $jobseeker_id)->first();
return redirect('/jobseeker');
}
public function showSendJobForm($id)
{
$jobseeker_id = Auth::user('jobseeker')->id;
$jobseeker = Jobseeker::find($jobseeker_id);
$job = Job::find($id);
return view('jobseeker.showjobsend', compact('job', 'jobseeker'));
}
public function sendJob($id)
{
$jobseeker = Input::get('jobseeker');
$friendEmail = Input::get('friend-email');
Mail::to($friendEmail)->send(new SendJobEmailNotification($jobseeker, $id));
return redirect('/jobseeker/jobs/' . $id);
}
public function favoriteJob(Job $job)
{
Auth::user('jobseeker')
->favorites()
->attach($job->id);

return back();
}

public function unFavoriteJob(Job $job)
{
Auth::user('jobseeker')
->favorites()
->detach($job->id);

return back();
}
}