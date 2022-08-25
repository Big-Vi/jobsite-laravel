@extends('layouts.app')

@section('content')
    <div class='hero-img'>
    <div class='ad row valign-wrapper'>
        <div class='col s7 m6 offset-m2'>
            <a href='/employer/createjob' class='btn btn-large waves-effect waves-light' id='ad_button'>Post job for free</a>
        </div>
        <div class='col s5 m4 valign-wrapper' style='height:4em;'>
            <span>Job posted {{$alljobs->count()}}</span>
        </div>
    </div>     
    </div>   
     
    <jobs style='margin-top:8em;'></jobs>
    <div id='home-hide'>
        {{-- <div class='feat'>
            <div class='text-center'>
                <h2>Featured Jobs</h2>
            </div>
            <div class='divi'></div>
            <div>
                <carousel :jobs='{{$jobcard}}'></carousel>
            </div>
        </div> --}}
        <section class='user container'>
            <div class="row">
                <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a class="active" href="#employer">For Employer</a></li>
                    <li class="tab col s3"><a href="#jobseeker">For Jobseeker</a></li>
                </ul>
                </div>
            </div>
            <div id="employer" class="row">
                <div class='col s12 m5 img'></div>
                <div class='col s12 m6 l5 offset-l1'>
                    <p>Easy & free to list jobs, with lot of insights about listed jobs like Number of saves, Number of time viewed by jobseekers and Email-alert of the listed job to the target specfic jobseekers.</p>
                    <a href='employer/signup' class='btn btn-primary'>Create Profile</a>
            </div>
            </div>
            <div id="jobseeker" class="row">
                <div class='col s12 m5 img'></div>
                    <div class='col s12 m6 l5 offset-l1'>
                        <p>Your Rowtram profile is your online resume along with email updates for matching jobs. Use it to apply for jobs and get yourself in front of the right people quickly and easily. Tell the world what you can bring to the table.</p>
                    <a href='jobseeker/signup' class='btn btn-primary'>Create Profile</a>
                </div>
            </div>            
        </section>
    </div>



@endsection
