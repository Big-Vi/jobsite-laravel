@extends('layouts.app')

@section('content')
<div class='signup center-align'>
  <h3 class='white-text'>Edit a jobalert</h3>
</div>
<div style='margin-top:8em;' class="container">
  <div style='margin-bottom:3em;'>
    <span><a href='/jobseeker'>Go Back</a></span>
  </div>

  <div class="row edit-jobalert justify-content-center">
    <div class="col-md-8">
      <form method='POST' action="/jobseeker/jobalert/{{$jobalert->id}}/edit"
        enctype="multipart/form-data">
        @csrf
        <jobalertedit :cate='{{$jobalert}}'>
        </jobalertedit>
        <button type='submit' class='btn btn-primary'>Update</button>
      </form>
    </div>
  </div>
</div>
@endsection