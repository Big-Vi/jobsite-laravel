<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobalert extends Model
{
  protected $fillable = ['keyword', 'category', 'subcategory', 'categoryindex', 'subcategoryindex', 'location'];
}