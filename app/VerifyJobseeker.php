<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyJobseeker extends Model
{
  protected $fillable = ['jobseeker_id', 'token'];

  public function jobseeker()
  {
    return $this->belongsTo('App\Jobseeker', 'jobseeker_id');
  }
}
