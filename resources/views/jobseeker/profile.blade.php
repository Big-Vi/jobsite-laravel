@extends('layouts.app')

@section('content')
<div class="jobseeker-profile">
    <div class="jobseeker-profile-info container-fluid">
        <div class='row'>
            <div class='col s12 m6 offset-m3 l4 offset-l4 white-text'>
                <h3>{{ Auth::guard('jobseeker')->user()->name }}</h3>
                <p>{{ Auth::guard('jobseeker')->user()->email }}</p>
                <a class='waves-effect btn white black-text modal-trigger' href='#edit-personal'>Edit Details</a>
            </div>
        </div>
        <div id="edit-personal" class="modal">
            <div class="modal-content">
                <form method='POST' action="/jobseeker/profile/{{ $jobseeker->id }}/edit" enctype="multipart/form-data">
                    @csrf
                    <div class='input-field col s12 m3'>
                            <input type='text' id='name' name='name' value="{{ $jobseeker->name }}">
                            <label for='name'>Enter Name</label>
                    </div>
                    <div class='input-field col m3 s12'>
                            <input id='email' type="text"
                                name='email' value={{ $jobseeker->email }}>
                            <label for="email">Email</label>
                    </div> 
                    <div class="modal-footer">
                        <button type='submit' class='btn btn-primary'>Update</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    <div class="addrole container-fluid">
        <div class="row">
            @foreach($roles as $role)
            <div class="col s12 m4">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                <span class="card-title">{{$role->jobtitle}}</span>
                <p>{{$role->description}}</p>
                </div>
                <div class="card-action">
                <a href="/jobseeker/profile/{{$role->id}}/editaddrole">Edit</a>
                <form  method='POST' action="/jobseeker/profile/{{$role->id}}/delete">
                        {{ method_field('DELETE') }}
                        <input class='form-control' type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button class='delete-role' type='submit'>Delete</button>
                </form>
                </div>
            </div>
            </div>
            @endforeach
        </div>
        <div class='row'>
            <div class='col s12 m6 offset-m3 l4 offset-l4'>
                <a class='waves-effect btn modal-trigger' href='#add-role'>Add Role</a>
            </div>
        </div>
        <div id="add-role" class="modal">
            <div class="modal-content">
                <form method='POST' action="/jobseeker/profile/{{ $jobseeker->id }}/addrole" enctype="multipart/form-data">
                    @csrf
                    <div class='input-field col m12'>
                            <input type='text' id='jobtitle' name='jobtitle'>
                            <label for='jobtitle'>Job Title</label>
                    </div>
                     <div class='input-field col m12'>
                            <input type='text' id='employer' name='employer'>
                            <label for='employer'>Employer</label>
                    </div>
                    <div class='input-field col m12'>
                            <textarea id='description' name='description'></textarea>
                            <label for='description'>Description</label>
                    </div>
                    <div class='input-field col m12'>
                            <input type="text" id='startdate' name='startdate' class="datepicker">
                            <label for='startdate'>Start Date</label>
                    </div>
                    <div>
                            <label>
                            <input class='stillinrole' type="checkbox" name="stillinrole" value="1" checked/>
                            <span>Still in role</span>
                            </label>
                    </div>
                    <div class='enddate input-field col m12'>
                            <input type="text" id='enddate' name='enddate' class="datepicker">
                            <label for='enddate'>End Date</label>
                    </div>
                    <div class="modal-footer">
                        <button type='submit' class='btn btn-primary'>Add Role</button>
                    </div>
                </form>
            </div>
            
        </div>
       
    </div>
</div>


@endsection

