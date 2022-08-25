<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyEmployer extends Model
{
  protected $fillable = ['employer_id', 'token'];

  public function employer()
  {
    return $this->belongsTo('App\Employer', 'employer_id');
  }
}
