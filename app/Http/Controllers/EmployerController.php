<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Employer;
use Illuminate\Support\Facades\Storage;
use Auth;
use Carbon\Carbon;

class EmployerController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth:employer');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $employer_id = Auth::user('employer')->id;
    $employer = Employer::find($employer_id);
    $jobs = Job::all()->where('employer_id', $employer_id);
    return view('employer.index', compact('jobs', 'employer'));
  }
  public function deleteMyProfile($id)
  {
    $employer = Employer::findOrFail($id);
    $jobs = Job::all();
    if ($jobs->count()) {
      $jobs = Job::all()->where('employer_id', $id);
      foreach ($jobs as $job) {
        $job->delete();
      }
      Storage::deleteDirectory("public/jobs/{$job->title}");
    }
    $employer->delete();
    return redirect('/employer');
  }
  public function showEmployers(Employer $employer)
  {
    return response()->json([
      'data' => [
        'title' => $employer->name,
        'description' => $employer->email
      ]
    ]);
  }

}