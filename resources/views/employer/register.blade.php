@extends('layouts.app')

@section('content')
<div class="employer-register container">
    <div class="row justify-content-center">
        <div>
            <div class='card'>
                <div class='card-content'>
                    <div class='card-title'>Employer Signup</div>
                    <form method='POST' action="{{ route('employer.signup.submit') }}">
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
                        <input class='form-control' type='password' name='password' id='employer_password'>
                        <label for='password'>Password</label>
                    </div>
                    <br> 
                    <button type='submit' class='btn waves-effect'>Submit</button>  
                    </div>            
                    </form>
                </div>
            </div>
            @if($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif
        </div>
    </div>
</div> 
@endsection
