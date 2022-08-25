@extends('layouts.app')

@section('content')
<div style='margin-top: 8em;' class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div>
        <span><a href='/employer'>Go Back</a></span>
        <?php 
        $value = strpos($job->title, '-'); 
        $jobTitle = substr($job->title,0,$value);
        ?>
        <h2><?= $jobTitle?></h2>
        <p>{!!$job->description!!}</p><br>
      </div>
      <div>

        <h3>submitted applications for this job</h3>
        @foreach ($jobseeker as $item)
        @if($item)
        {{$item->jobseeker}}<br>
        <a target='_blank' href='/storage/jobs/<?=str_replace(' ', '-', $employer->name)?>/<?=str_replace(' ', '-', $job->title)?>/submitted-applications/<?=str_replace(' ', '-', $item->cv)?>'>Download</a><br>
        <a target='_blank' href='/storage/jobs/<?=str_replace(' ', '-', $employer->name)?>/<?=str_replace(' ', '-', $job->title)?>/submitted-applications/<?=str_replace(' ', '-', $item->coverletter)?>'>Download</a><br>
        @else
        <p>No submitted application yet</p>
        @endif
        @endforeach

      </div>
    </div>
  </div>
</div>
@endsection
