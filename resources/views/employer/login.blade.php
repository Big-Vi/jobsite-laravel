@extends('layouts.app')

@section('content')
<div class="employer-login container">
    <div class="row">
        <div>
            <div class="card">
                <div class="card-content">
                    <div class="card-title">{{ __('Employer Login') }}</div>
                    <form method="POST" action="{{ route('employer.login.submit') }}">
                        @csrf

                        <div class="row">
                            

                            <div class='input-field'>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            <div class="input-field row">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <label for="password" >{{ __('Password') }}</label>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                                <div class="form-check">
                                    <label class="form-check-label" for="remember">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span>{{ __('Remember Me') }}</span>
                                    </label>
                                </div>
                              

                        <div class="row" style='margin-top: 1em;'>
                            <div>
                                <button type="submit" class="btn waves-effect">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn waves-effect" href="{{ route('employer.password.request') }}">
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
