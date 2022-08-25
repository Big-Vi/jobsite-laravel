@extends('layouts.app')

@section('content')
<div class='signup center-align'>
  <h3 class='white-text'>Create job alert</h3>
</div>
<div style='margin-top:8em;' class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
            <form action='{{route('storejobalert')}}' method='POST'>
                @csrf
                    <jobalert></jobalert>
                    <div class='input-field col m3 s12'>
                        <button type='submit' class='btn waves-effect'>Submit</button>
                    </div>
                    
            </form>
            </div>
        </div>
        
    </div>
</div>
@endsection
