<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Job;
use Illuminate\Support\Facades\Storage;
use App\Employer;
use Session;
use Stripe;
use App\Mail\JobCreatedEmailNotification;
use App\Notifications\JobCreatedNotification;
use Illuminate\Support\Facades\Mail;
use App\Submittedjob;
use Carbon\Carbon;

class EmployerJobController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:employer');
    
  }
  public function showCreateJobForm()
  {
    return view('employer.createjob');
  }
  public function createJob(Request $request)
  {
    $attributes = request()->validate([
      'title' => 'required',
      'active' => 'required',
      'description' => 'required|min:10',
      'pitch' => 'required|nullable',
      'category' => 'required',
      'categoryindex' => 'required',
      'subcategoryindex' => 'required',
      'subcategory' => 'required',
      'worktype' => 'required|nullable',
      'payrange' => 'required|nullable',
      'location' => 'required|nullable',
      'logo' => 'image|nullable|max:1999'
    ]);
    $employer_id = Auth::user('employer')->id;
    $employer = Employer::find($employer_id);
    //handle file upload
    if ($request->hasFile('logo')) {
      //Get filename with the extension
      $filenameWithExt = $request->file('logo')->getClientOriginalName();
      // Get just filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      // Get just ext
      $extension = $request->file('logo')->getClientOriginalExtension();
      //Filename to store
      $fileNameToStore = $filename . '_' . time() . '.' . $extension;
      //timestamp
      $t = time();
      //upload image
      $path = $request
        ->file('logo')
        ->storeAs("public/jobs/{$attributes['title']}-" . $t . '/logo_images', $fileNameToStore);
    } else {
      $fileNameToStore = 'noimage.jpg';
    }
    $t = time();
    $job = Job::create($attributes);
    $job->title = $attributes['title'] . '-' . $t;
    $job->logo = $fileNameToStore;
    $employer->jobs()->save($job);
    Stripe\Stripe::setApiKey('sk_test_qesLbXcJhfSH7mCsgxCnRT6D');
    Stripe\Charge::create([
      'amount' => 100 * 100,
      'currency' => 'nzd',
      'source' => $request->stripeToken,
      'description' => 'Test payment'
    ]);
    Mail::to($employer->email)->send(new JobCreatedEmailNotification($job));
    auth()
      ->user()
      ->notify(new JobCreatedNotification($job));
    return redirect('/employer')->with('success', 'Payment success & Job created');
  }
  public function showCreatedJob($id)
  {
    $jobseeker = Submittedjob::where('job_id', $id)->get();
    $employer_id = Auth::user('employer')->id;
    $employer = Employer::find($employer_id);
    $job = Job::findOrFail($id);
    // dd($jobseeker);
    return view('employer.showjob', compact('job', 'employer', 'jobseeker'));
  }
  public function editCreatedJobForm($id)
  {
    $employer_id = Auth::user('employer')->id;
    $employer = Employer::find($employer_id);
    $job = Job::findOrFail($id);
    return view('employer.editjob', compact('job', 'employer'));
  }
  public function markAsRead(Request $request)
  {
    $notificationId = $request->id;

    $userUnreadNotification = auth()
      ->user()
      ->unreadNotifications->where('id', $notificationId)
      ->first();

    if ($userUnreadNotification) {
      $userUnreadNotification->markAsRead();
    }
  }
  public function updateCreatedJob($id, Request $request)
  {
    $job = Job::findOrFail($id);
    $value = strpos($job->title, '-');
    $titlevalue = substr($job->title, $value, 100);
    $job->title = request('title') . $titlevalue;
    $job->category = request('category');
    $job->categoryindex = request('categoryindex');
    $job->subcategoryindex = request('subcategoryindex');
    $job->subcategory = request('subcategory');
    $job->location = request('location');
    $job->pitch = request('pitch');
    $job->worktype = request('worktype');
    $job->payrange = request('payrange');
    $job->description = request('description');
    $employer_id = Auth::user('employer')->id;
    $employer = Employer::find($employer_id);
    //handle file upload
    if ($request->hasFile('logo')) {
      //Get filename with the extension
      $filenameWithExt = $request->file('logo')->getClientOriginalName();
      // Get just filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      // Get just ext
      $extension = $request->file('logo')->getClientOriginalExtension();
      //Filename to store
      $fileNameToStore = $filename . '_' . time() . '.' . $extension;
      //Delete the existing file from storage
      Storage::delete("public/jobs/{$job->title}/logo_images/" . $job->logo);
      //upload image
      $path = $request
        ->file('logo')
        ->storeAs("public/jobs/{$job->title}/logo_images", $fileNameToStore);
      $job->logo = $fileNameToStore;
    }

    $job->save();
    return redirect('employer');
  }
  public function deleteCreatedJob($id)
  {
    $employer_id = Auth::user('employer')->id;
    $employer = Employer::find($employer_id);
    $job = Job::findOrFail($id);
    $job->delete();
    Storage::deleteDirectory("public/jobs/{$job->title}");
    return redirect('employer');
  }
 
}