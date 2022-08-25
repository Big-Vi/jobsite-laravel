<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\VerifyEmployerMail;
use App\Employer;
use App\VerifyEmployer;
class EmployerLoginController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest:employer', ['except' => 'logout']);
  }
  public function showLoginForm()
  {
    return view('employer.login');
  }
  public function login(Request $request)
  {
    Auth::guard('jobseeker')->logout();
    //Validate the form data
    $attributes = request()->validate([
      'email' => 'required|email',
      'password' => 'required|min:6'
    ]);
    //verify email
    $employer = Employer::where('email', $request->email)->first();
    if ($employer) {
      if (!$employer->verified) {
        auth('employer')->logout();
        return view('auth.verifyEmployer', compact('employer'));
      }
    }

    //Attempt to log the user in
    if (
      Auth::guard('employer')->attempt(
        ['email' => $request->email, 'password' => $request->password],
        $request->remember
      )
    ) {
      //If successful, redirect
      return redirect()->intended(route('employer.dashboard'));
    }

    //If unsuccessful, redirect back to login with form data
    return redirect()
      ->back()
      ->withInput($request->only('email', 'remember'));
  }

  public function showSignupForm()
  {
    return view('employer.register');
  }
  public function signup(Employer $employer, Request $request)
  {
    $email = Input::get('email');
    if ($employer = Employer::where('email', $email)->first()) {
      return redirect('/employer/signup')->withErrors('email exist already.enter another one');
    }
    $attributes = request()->validate([
      'name' => 'required',
      'email' => 'required',
      'password' => 'required|min:6'
    ]);
    $employer = Employer::create([
      'name' => $attributes['name'],
      'email' => $attributes['email'],
      'password' => Hash::make($attributes['password'])
    ]);
    $employer->save();
    $verifyEmployer = VerifyEmployer::create([
      'employer_id' => $employer->id,
      'token' => str_random(32)
    ]);
    Mail::to($employer->email)->send(new VerifyEmployerMail($employer));
    return view('auth.verifyEmployer', compact('employer'));
  }
  public function resendVerificationEmail($id)
  {
    $employer = Employer::find($id);
    Mail::to($employer->email)->send(new VerifyEmployerMail($employer));
    return view('auth.verifyEmployer', compact('employer'));
  }
  public function logout(Request $request)
  {
    echo 'l';
    Auth::guard('employer')->logout();
    return redirect('/employer/login');
  }
  public function verifyEmployer($token)
  {
    $verifyEmployer = VerifyEmployer::where('token', $token)->first();
    if (isset($verifyEmployer)) {
      $employer = $verifyEmployer->employer;
      if (!$employer->verified) {
        $verifyEmployer->employer->verified = 1;
        $verifyEmployer->employer->save();
        $status = 'Your e-mail is verified. You can now login.';
      } else {
        $status = 'Your e-mail is already verified. You can now login.';
      }
    } else {
      return redirect('/employer/login')->with('warning', 'Sorry your email cannot be identified.');
    }
    return redirect('/employer/login')->with('status', $status);
  }
}