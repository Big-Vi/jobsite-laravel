<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Redirect;
use URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Jobseeker;
use Illuminate\Support\Facades\Validator;
use App\VerifyJobseeker;
use App\Mail\VerifyJobseekerMail;

class JobseekerLoginController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest:jobseeker', ['except' => 'logout']);
  }
  public function showLoginForm()
  {
    Session::put('url.intended', URL::previous());
    return view('jobseeker.login');
  }
  public function login(Request $request)
  {
    Auth::guard('employer')->logout();
    //Validate the form data
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required|min:6'
    ]);
    //verify email
    $jobseeker = Jobseeker::where('email', $request->email)->first();
    if ($jobseeker) {
      if (!$jobseeker->verified) {
        auth('jobseeker')->logout();
        return view('auth.verifyJobseeker', compact('jobseeker'));
      }
    }

    //Attempt to log the user in
    if (
      Auth::guard('jobseeker')->attempt(
        ['email' => $request->email, 'password' => $request->password],
        $request->remember
      )
    ) {
      //If successful, redirect
      return Redirect::to(Session::get('url.intended'));
    }

    //If unsuccessful, redirect back to login with form data
    return redirect()
      ->back()
      ->withInput($request->only('email', 'remember'));
  }

  public function showSignupForm()
  {
    return view('jobseeker.register');
  }
  public function signup(Jobseeker $jobseeker)
  {
    $email = Input::get('email');
    if ($jobseeker = Jobseeker::where('email', $email)->first()) {
      return redirect('/jobseeker/signup')->withErrors('email exist already.enter another one');
    }
    $attributes = request()->validate([
      'name' => 'required',
      'email' => 'required',
      'password' => 'required|min:6'
    ]);
    $jobseeker = Jobseeker::create([
      'name' => $attributes['name'],
      'email' => $attributes['email'],
      'password' => Hash::make($attributes['password'])
    ]);
    $jobseeker->save();
    $verifyJobseeker = VerifyJobseeker::create([
      'jobseeker_id' => $jobseeker->id,
      'token' => sha1(time())
    ]);
    Mail::to($jobseeker->email)->send(new VerifyJobseekerMail($jobseeker));
    return view('auth.verifyJobseeker', compact('jobseeker'));
  }
  public function resendVerificationEmail($id)
  {
    $jobseeker = Jobseeker::find($id);
    Mail::to($jobseeker->email)->send(new VerifyJobseekerMail($jobseeker));
    return view('auth.verifyJobseeker', compact('jobseeker'));
  }
  public function verifyJobseeker($token)
  {
    $verifyJobseeker = VerifyJobseeker::where('token', $token)->first();
    if (isset($verifyJobseeker)) {
      $jobseeker = $verifyJobseeker->jobseeker;
      if (!$jobseeker->verified) {
        $verifyJobseeker->jobseeker->verified = 1;
        $verifyJobseeker->jobseeker->save();
        $status = 'Your e-mail is verified. You can now login.';
      } else {
        $status = 'Your e-mail is already verified. You can now login.';
      }
    } else {
      return redirect('/jobseeker/login')->with(
        'warning',
        'Sorry your email cannot be identified.'
      );
    }
    return redirect('/jobseeker/login')->with('status', $status);
  }
  public function logout(Request $request)
  {
    Auth::guard('jobseeker')->logout();
    return redirect('/jobseeker/login');
  }
}
