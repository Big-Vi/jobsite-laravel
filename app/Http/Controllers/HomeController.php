<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Job;
use Carbon\Carbon;
use App\Contact;
use Illuminate\Support\Facades\Input;
use App\Events\SearchEvent;
use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    // $this->middleware('auth', ['except' => 'logout']);
    // $this->middleware('auth:jobseeker')->only('getJobs');
  }
  public function logout()
  {
    auth()->logout();
    return redirect('/login');
  }
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $jobs = Job::paginate(4);
    $jobcardJson = Job::paginate(100);
    $alljobs = Job::all();
    $jobcard = json_encode($jobcardJson, JSON_PRETTY_PRINT);
    return view('home', compact('jobs', 'jobcard', 'alljobs'));
    // dd(json_encode($jobs, JSON_PRETTY_PRINT));
  }
  public function contact()
  {
    return view('contact');
  }
  public function saveContact()
  {
    $contact = new Contact();
    $contact->fullname = request('fullname');
    $contact->email = request('email');
    $contact->message = request('message');
    $contact->mobile = request('mobile');
    $contact->save();
    Mail::to('vignesheanz@gmail.com')->send(new ContactEmail($contact));
    return back()->with('success', 'Form successfully submitted!');
  }
  public function searchJob(Request $request)
  {
    $keywords = $request->keywords;
    $category = $request->category;
    $subcategory = $request->subcategory;
    $location = $request->location;
    $worktype = $request->worktype;
    $timeposted = $request->timeposted;
    if (!$timeposted) {
      $timeposted = 30;
    }
    $sliderValue = $request->sliderValue;
    $today = Carbon::today();
    $jobs = Job::where('title', 'LIKE', "%{$keywords}%")
      ->where('category', 'LIKE', "%{$category}%")
      ->where('subcategory', 'LIKE', "%{$subcategory}%")
      ->where('location', 'LIKE', "%{$location}%")
      ->where('worktype', 'LIKE', "%{$worktype}%")
      ->where('payrange', '>', $sliderValue)
      ->where('created_at', '>', $today->subDays($timeposted))
      ->paginate(4);
    return response()->json($jobs);
  }
  public function destroyJob($id)
  {
    $job = Job::findOrFail($id);
    Storage::deleteDirectory("public/jobs/{$job->title}");
    return Job::destroy($id);
  }
}