<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/contact', 'HomeController@contact');
Route::post('/contact', 'HomeController@saveContact');
Route::get('/logout', 'HomeController@logout');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('employer')->group(function () {
  Route::get('/login', 'Auth\EmployerLoginController@showLoginForm')->name('employer.login');
  Route::post('/login', 'Auth\EmployerLoginController@login')->name('employer.login.submit');
  Route::get('/signup', 'Auth\EmployerLoginController@showSignupForm')->name('employer.signup');
  Route::get('/resend/{id}', 'Auth\EmployerLoginController@resendVerificationEmail')->name(
    'employer.resend'
  );
  Route::post('/signup', 'Auth\EmployerLoginController@signup')->name('employer.signup.submit');
  Route::get('/', 'EmployerController@index')->name('employer.dashboard');
  Route::get('/logout', 'Auth\EmployerLoginController@logout');
  Route::delete('/deleteprofile/{id}', 'EmployerController@deleteMyProfile');
  Route::get('/verify/{token}', 'Auth\EmployerLoginController@verifyEmployer');

  ///Password reset routes
  Route::post('/password/email', 'Auth\EmployerForgotPasswordController@sendResetLinkEmail')->name(
    'employer.password.email'
  );
  Route::get('/password/reset', 'Auth\EmployerForgotPasswordController@showLinkRequestForm')->name(
    'employer.password.request'
  );
  Route::post('/password/reset', 'Auth\EmployerResetPasswordController@reset');
  Route::get('/password/reset/{token}', 'Auth\EmployerResetPasswordController@showResetForm')->name(
    'employer.password.reset'
  );

  //CRUD Job
  Route::get('/createjob', 'EmployerJobController@showCreateJobForm')->name('employer.job.create');
  Route::post('/createjob', 'EmployerJobController@createJob');
  Route::get('/job/{id}', 'EmployerJobController@showCreatedJob');
  Route::get('/job/{id}/edit', 'EmployerJobController@editCreatedJobForm');
  Route::post('/job/{id}/edit', 'EmployerJobController@updateCreatedJob');
});

Route::prefix('jobseeker')->group(function () {
  Route::get('/login', 'Auth\JobseekerLoginController@showLoginForm')->name('jobseeker.login');
  Route::post('/login', 'Auth\JobseekerLoginController@login')->name('jobseeker.login.submit');
  Route::get('/signup', 'Auth\JobseekerLoginController@showSignupForm')->name('jobseeker.signup');
  Route::post('/signup', 'Auth\JobseekerLoginController@signup')->name('jobseeker.signup.submit');
  Route::get('/', 'JobseekerController@index')->name('jobseeker.dashboard');
  Route::get('/logout', 'Auth\JobseekerLoginController@logout');
  Route::get('/resend/{id}', 'Auth\JobseekerLoginController@resendVerificationEmail')->name(
    'jobseeker.resend'
  );
  Route::get('/verify/{token}', 'Auth\JobseekerLoginController@verifyJobseeker');
  //Rest password
  Route::get('/password/reset', 'Auth\JobseekerForgotPasswordController@showLinkRequestForm')->name(
    'jobseeker.password.request'
  );
  Route::post('/password/email', 'Auth\JobseekerForgotPasswordController@sendResetLinkEmail')->name(
    'jobseeker.password.email'
  );
  Route::post('/password/reset', 'Auth\JobseekerResetPasswordController@reset');
  Route::get(
    '/password/reset/{token}',
    'Auth\JobseekerResetPasswordController@showResetForm'
  )->name('jobseeker.password.reset');

  //Search job

  Route::get('/jobs/{id}', 'JobseekerJobController@showJob');
  Route::get('/jobs/{id}/apply', 'JobseekerJobController@showapplyJob');
  Route::get('/jobs/{id}/send', 'JobseekerJobController@showSendJobForm');
  Route::post('/jobs/{id}/send', 'JobseekerJobController@sendJob');
  Route::post('/jobs/{id}/apply', 'JobseekerJobController@applyJob');
  Route::get('/jobalert', 'JobseekerJobController@showJobalert')->name('showjobalert');
  Route::post('/jobalert', 'JobseekerJobController@storeJobalert')->name('storejobalert');
  Route::get('/jobalert/{id}/edit', 'JobseekerJobController@editJobalert')->name(
    'jobseeker.editjobalert'
  );
  Route::post('/jobalert/{id}/edit', 'JobseekerJobController@updateJobalert');
  Route::delete('/jobalert/{id}/delete', 'JobseekerJobController@deleteJobalert');
  Route::get('/profile', 'JobseekerController@showProfile');
  Route::post('/profile/{id}/edit', 'JobseekerController@editPersonal');
  Route::post('/profile/{id}/addrole', 'JobseekerController@addRole');
  Route::delete('/profile/{id}/delete', 'JobseekerController@deleteRole');
  Route::get('/profile/{id}/editaddrole', 'JobseekerController@editAddRole');
  Route::post('/profile/{id}/editaddrole', 'JobseekerController@editRole');
});

Route::get('/markAsRead', 'EmployerJobController@markAsRead');

//Save job
Route::post('/favorite/{job}', 'JobseekerJobController@favoriteJob');
Route::post('/unfavorite/{job}', 'JobseekerJobController@unFavoriteJob');

Route::get('my_favorites', 'JobseekerJobController@myFavorites');