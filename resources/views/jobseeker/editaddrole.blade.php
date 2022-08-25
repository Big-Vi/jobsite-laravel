@extends('layouts.app')
@section('content')
<div class='container' id="roleedit">
   <div class='row'>
        <form method='POST' action="/jobseeker/profile/{{$role->id}}/editaddrole" enctype="multipart/form-data">
        @csrf
        <div class='input-field col m12'>
                                    <input type='text' id='jobtitle' name='jobtitle' value="{{$role->jobtitle}}">
                                    <label for='jobtitle'>Job Title</label>
        </div>
                            <div class='input-field col m12'>
                                    <input type='text' id='employer' name='employer' value="{{$role->employer}}">
                                    <label for='employer'>Employer</label>
                            </div>
                            <div class='input-field col m12'>
                                    <textarea id='description' name='description'>{{$role->description}}</textarea>
                                    <label for='description'>Description</label>
                            </div>
                            <div class='input-field col m12'>
                                    <input type="text" id='startdate' name='startdate' class="datepicker" value="{{$role->startdate}}">
                                    <label for='startdate'>Start Date</label>
                            </div>
                            <div>
                                <label>
                                @if($role->stillinrole == 1)
                                    <input class='stillinrole' type="checkbox" name="stillinrole" value="1" checked/>
                                @elseif($role->stillinrole == 0)
                                <input class='stillinrole' type="checkbox" name="stillinrole" value="1"/>
                                @else
                                @endif
                                <span>Still in role</span>
                                </label>
                            </div>
                            <div class='enddate input-field col m12'>
                                    <input type="text" id='enddate' name='enddate' class="datepicker" value="{{$role->enddate}}">
                                    <label for='enddate'>End Date</label>
                            </div>
                            <div class="modal-footer">
                                <button type='submit' class='btn btn-primary'>Update Role</button>
                            </div>
                        </form>
                    </div>    
    </div>
@endsection

          
                 