<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\notifications\EmployerResetPasswordNotification;
use App\User;

class Employer extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, Notifiable;
  // protected $guard = 'employer';

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
    $this->notify(new EmployerResetPasswordNotification($token));
  }
  public function jobs()
  {
    return $this->hasMany('App\Job', 'employer_id', 'id');
  }
  public function verifyEmployer()
  {
    return $this->hasOne('App\VerifyEmployer');
  }
}
