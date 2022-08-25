<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Job;
use App\notifications\JobseekerResetPasswordNotification;

class Jobseeker extends Authenticatable implements MustVerifyEmail
{
  use Notifiable, HasApiTokens;
  // protected $guard = 'jobseeker';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'email', 'password'];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = ['password', 'remember_token'];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime'
  ];
  public function sendPasswordResetNotification($token)
  {
    $this->notify(new JobseekerResetPasswordNotification($token));
  }
  public function verifyJobseeker()
  {
    return $this->hasOne('App\VerifyJobseeker');
  }
  public function favorites()
  {
    return $this->belongsToMany(
      Job::class,
      'favorites',
      'jobseeker_id',
      'job_id'
    )->withTimeStamps();
  }
  public function jobalerts()
  {
    return $this->hasMany('App\Jobalert', 'jobseeker_id', 'id');
  }
  public function addrole()
  {
    return $this->hasMany('App\Addrole', 'jobseeker_id', 'id');
  }
}
