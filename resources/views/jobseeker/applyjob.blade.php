@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col m10 l8 offset-l2">
      <?php $value = strpos($job->title, '-'); ?>
      <h3>{{substr($job->title,0,$value)}}</h3>
      <form method='POST' action='/jobseeker/jobs/{{$job->id}}/apply'
        enctype="multipart/form-data">
        @csrf
        <input name='jobseeker' value='{{$jobseeker->name}}'>
        <input name='jobseeker-email' value='{{$jobseeker->email}}'>
        @if($role)
        <h4>Recent Role</h4>
        <input name='jobtitle' value='{{$role->jobtitle}}'>
        <input name='employer' value='{{$role->employer}}'>
        <input name='duration' value="{{$monthInJob}}"><span>Months in the
          job</span>
        @endif
        <input type='hidden' name='jobseeker_id' value='{{$jobseeker->id}}'>
        <input type='hidden' name='job_id' value='{{$job->id}}'><br>
        <h4>Attach Document</h4>
        <div>
          <label>Upload Cover letter</label>
          <input type='file' name='coverletter'><br>
        </div>
        <div>
        <label>Upload CV</label>
          <input type='file' name='cv'>
        </div><br>
        <div>
        <button type='submit' class='btn btn-primary'>Submit</button>
        </div>
      </form> <br>
    </div>
  </div>
</div>
@endsection