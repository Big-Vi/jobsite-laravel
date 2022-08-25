@extends('layouts.app')

@section('content')
<div class='jobseeker-hero-img'></div>

<jobs></jobs>
<div id='home-hide'>
    <section class='jobseeker-dash container'>
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a href="#applied">Applied Jobs</a></li>
                    <li class="tab col s3"><a href="#reccommended">Reccommended Jobs</a></li>
                    <li class="tab col s3"><a class="active" href="#saved">Job Alert</a></li>
                </ul>
            </div>
        </div>
        <div id="applied" class="row">
            <div class='col s12 m10 l12 offset-l1'>
                <appliedjob :appliedjobs='{{json_encode($appliedjob)}}'></appliedjob>
            </div>
        </div>
        <div id="reccommended" class="row">
            <div class='col s12 m10 l12 offset-l1'>
                @if($jobalerts != null)
                        @foreach ($reccommendedJobs as $jobcollections)
                        @if(count($jobcollections)<1)
                        <p>No jobs matching your jobalert or no jobs
                          posted
                          in
                          the database yet.</p>
                          @else
                                @foreach ($jobcollections as $jobcollection)
                                <?php $value = strpos($jobcollection->title, '-'); ?>
                                <ul>
                                    <li style='list-style-type:disc;'>
                                      <a href='/jobseeker/jobs/{{$jobcollection->id}}'>{{substr($jobcollection->title,0,$value)}}</a>
                                    </li>
                                </ul>
                                @endforeach
                         @endif
                                
                        @endforeach
                @else 
                    <p>Please create job alert to show you reccommended jobs.</p>
                @endif
            </div>
        </div>
        <div id="saved" class="row">
            <div class='col s12 m10 l12'>
                @if($jobalerts != null)
                <div class="col s12 m10 l6 offset-l1">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <p>Keyword: {{$jobalerts->keyword}}</p>
                            <p>Category: {{$jobalerts->category}}</p>
                            <p>Sub Category: {{$jobalerts->subcategory}}</p>
                            <p>Location: {{$jobalerts->location}}</p>
                        </div>
                        <div class="card-action">
                            <a href="/jobseeker/jobalert/{{$jobalerts->id}}/edit">Edit</a>
                            <form method='POST' action="/jobseeker/jobalert/{{$jobalerts->id}}/delete">
                                {{ method_field('DELETE') }}
                                <input class='form-control' type="hidden" name="_token"
                                    value="<?php echo csrf_token(); ?>">
                                <button class='delete-jobalert' type='submit'>Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <p>No Jobalert to show</p>
                <a href='/jobseeker/jobalert'><button class='waves-effect btn'>Create Job Alert</button></a>
                @endif
            </div>
        </div>
    </section>
</div>



@endsection