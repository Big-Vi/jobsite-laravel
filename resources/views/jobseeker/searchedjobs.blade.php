@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                @foreach($jobs as $job)
                    <div class="card">
                        <div class="card-body">
                            <a href='/jobseeker/jobs/{{$job->id}}'>{{$job->title}}</a>
                        </div>      
                    </div>  <br>          
                @endforeach
        </div>
    </div>
</div>
@endsection

