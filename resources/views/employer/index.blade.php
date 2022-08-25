@extends('layouts.app')

@section('content')
<div class="container">
    <employerindex :jobs="{{$jobs}}" :employer="{{$employer}}" :auth_user="{{Auth::user()->id}}"></employerindex>
</div>
@endsection