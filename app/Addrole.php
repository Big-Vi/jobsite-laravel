<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addrole extends Model
{
  protected $fillable = [
    'jobtitle',
    'description',
    'employer',
    'startdate',
    'enddate',
    'stillinrole'
  ];
}
