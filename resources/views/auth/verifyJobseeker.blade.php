@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col m10 l8 s10 offset-l2 offset-m1">
            <div>
                <div>
                    <h3>{{ __('Verify Your Email Address') }}</h3>
                </div>
                <div>
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form action="{{route('jobseeker.resend', $jobseeker->id)}}" method='GET'>
                        <input class='form-control' type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button style='margin-top:1em;' class='waves-effect btn blue' type='submit'>{{ __('click here to request another') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection