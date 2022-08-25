@extends('layouts.app')

@section('content')
<div class='signup center-align'>
    <h3 class='white-text'>Jobseeker Signup</h3>
</div>
<div class="jobseeker-register container">
    <div class="row">
        <div class='col m8 s10 l8 offset-l2'>
            <form method='POST' action="{{ route('jobseeker.signup.submit') }}">
                <div class='form-group'>
                    <input class='form-control' type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class='input-field'>
                        <input class='form-control' name='name' type='text' id='employer_name'>
                        <label for='name'>Name</label>
                    </div>
                    <div class='input-field'>
                        <input class='form-control' type='email' name='email' id='employer_email'>
                        <label for='email'>Email</label>
                    </div>
                    <div class='input-field'>
                        <input class='form-control' type='password' min='6' name='password' id='employer_password'>
                        <label for='password'>Password</label>
                    </div>
                    <br>
                    <button type='submit' class='btn waves-effect'>Submit</button>
                </div>
            </form>
            <div class='errors'>
                @if($errors->any())
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection