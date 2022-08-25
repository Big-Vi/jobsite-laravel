@extends('layouts.app')

@section('content')
<div class="container" style='margin-top:8em;'>
  <div class="row">
    <div class="col s12 m10 l8 offset-l2">
    <form method='POST' action='/jobseeker/jobs/{{$job->id}}/send'>
      @csrf
      <div class="card ">
        <div class="card-content">
          <?php $value = strpos($job->title, '-'); ?>
          <span class="card-title">Job Title:
            {{substr($job->title,0,$value)}}</span>
          
            <input name='jobseeker' value='{{$jobseeker->name}}'>
            <div class='input-field col m8 l12 s12'>
              <input id='enter-email' type='email' name='friend-email'>
              <label for="enter-email">Enter your friend email</label>
            </div>
            <p>{{$job->pitch}}</p>
        </div>
        <div class="card-action">
          <button type='submit' class='btn btn-primary'>Send</button>
        </div>
        
      </div>
      </form>
    </div>
  </div>
</div>
@endsection