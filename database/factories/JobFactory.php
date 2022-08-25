<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
  return [
    'title' => $faker->title,
    'employer_id' => 1,
    'logo' => 'noimage.jpg',
    'category' => $faker->text(10),
    'location' => $faker->text(10),
    'description' => $faker->text(100)
  ];
});
