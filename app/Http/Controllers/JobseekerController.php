<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Jobseeker;
use App\Jobalert;
use App\Addrole;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Submittedjob;
use App\Http\Controllers\JobsTrait;

class jobseekerController extends Controller
{
use JobsTrait;
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth:jobseeker');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $jobseeker_id = Auth::user('jobseeker')->id;
    $submittedjobs = Submittedjob::where('jobseeker_id', $jobseeker_id)->get();
    $jobalerts = Jobalert::where('jobseeker_id', $jobseeker_id)->first();
    $appliedjob = [];
    
    if ($submittedjobs->count()) {
      foreach ($submittedjobs as $item) {
        $job_id = $item->job_id;
        $jobs = Job::find($job_id);
        array_push($appliedjob, $jobs);
      }
    }
    $jobs = Job::paginate(4);
    $reccommendedJobs = $this->reccommendedjob();
    return view('jobseeker.index', compact('jobs', 'jobalerts', 'appliedjob', 'reccommendedJobs'));
  }

  public function showProfile()
  {
    $jobseeker_id = Auth::user('jobseeker')->id;
    $jobseeker = Jobseeker::find($jobseeker_id);
    $roles = Addrole::all()->where('jobseeker_id', $jobseeker_id);
    return view('jobseeker.profile', compact('jobseeker', 'roles'));
  }

  public function editPersonal($id)
  {
    $jobseeker = Jobseeker::findOrFail($id);
    $jobseeker->name = request('name');
    $jobseeker->email = request('email');
    $jobseeker->save();
    return redirect('/jobseeker/profile');
  }
  public function addRole()
  {
    if (request('stillinrole') == '1') {
      $role = new Addrole();
      $role->stillinrole = 1;
    } else {
      $role = new Addrole();
      $role->stillinrole = 0;
    }
    $role->jobtitle = request('jobtitle');
    $role->employer = request('employer');
    $role->description = request('description');
    $role->startdate = request('startdate');
    $role->enddate = request('enddate');
    $jobseeker_id = Auth::user('jobseeker')->id;
    $jobseeker = Jobseeker::find($jobseeker_id);
    $jobseeker->addrole()->save($role);
    return redirect('/jobseeker/profile');
  }
  public function deleteRole($id)
  {
    $role = Addrole::findOrFail($id);
    $role->delete();
    return redirect('/jobseeker/profile');
  }
  public function editRole($id)
  {
    if (request('stillinrole') == '1') {
      $role = Addrole::findOrFail($id);
      $role->stillinrole = 1;
    } else {
      $role = Addrole::findOrFail($id);
      $role->stillinrole = 0;
    }

    $role->jobtitle = request('jobtitle');
    $role->employer = request('employer');
    $role->description = request('description');
    $role->startdate = request('startdate');
    $role->enddate = request('enddate');
    $role->save();
    return redirect('/jobseeker/profile');
  }
  public function editAddRole($id)
  {
    $role = Addrole::findOrFail($id);
    return view('jobseeker.editaddrole', compact('role'));
  }
  
}