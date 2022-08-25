<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submittedjob extends Model
{
  protected $fillable = ['jobseeker', 'cv', 'jobseeker_id', 'job_id', 'coverletter'];
}