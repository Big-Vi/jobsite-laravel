@extends('layouts.app')

@section('content')
<div class='signup center-align'>
    <h3 class='white-text'>Jobseeker Login</h3>
</div>
<div class="jobseeker-login container">
    <div class="row justify-content-center">
        <div class='col s12 m8 l8 offset-l2'>
            <div class="card">
                <div class="card-content">
                    <form method="POST" action="{{ route('jobseeker.login.submit') }}">
                        @csrf

                        <div class="row">
                            <div class="input-field">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-check">
                                <label class="form-check-label" for="remember">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span>{{ __('Remember Me') }}</span>
                                </label>
                        </div>

                        <div class="form-group row" style='margin-top:1em;'>
                            <div>
                                <button type="submit" class="btn waves-effect">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn waves-effect" href="{{ route('jobseeker.password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
