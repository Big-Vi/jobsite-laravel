<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employer;
use Illuminate\Support\Facades\Auth;
use App\Favorite;

class Job extends Model
{
  protected $fillable = [
    'title',
    'description',
    'category',
    'categoryindex',
    'subcategoryindex',
    'subcategory',
    'location',
    'worktype',
    'pitch',
    'payrange',
    'active'
  ];
  public function employer()
  {
    return $this->belongsTo('App\Employer');
  }
  public function favorited()
  {
    return (bool) Favorite::where('jobseeker_id', Auth::id())
      ->where('job_id', $this->id)
      ->first();
  }
}