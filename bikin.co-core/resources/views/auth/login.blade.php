@extends('app')

@section('content')

@include('sweetalert::alert')

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
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
</div> --}}

<div class="uk-flex uk-flex-center uk-flex-middle sc-login-page-wrapper">
    <div class="uk-width-2-3@s uk-width-1-2@m uk-width-1-3@l uk-width-1-4@xl">
        <div class="uk-card">
            <div class="uk-card-body">
                <div class="sc-login-page-logo">
                    <img src="{{ asset('img/logo_alt.png')}}" alt="">
                </div>
                <div class="sc-login-page-logo sc-login-page-logo-light">
                    <img src="{{ asset('img/logo.png')}}" alt="">
                </div>
          
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div id="sc-login-form" class="sc-toggle-login-register sc-toggle-login-password">
                        <div class="sc-login-page-inner">
                            <div class="uk-margin-medium">
                                <label for="sc-login-username">Email / Username</label>
                                <input id="sc-login-username" type="text" class="uk-input" data-sc-input @error('email')
                                    is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="uk-margin-medium">
                                <label for="sc-login-password">Password</label>
                                <input id="sc-login-password" type="password" class="uk-input" data-sc-input
                                    @error('password') is-invalid @enderror" name="password" required>
                                <div class="uk-margin-small-top uk-text-small uk-text-right@s"><a href="#"
                                        class="sc-link"
                                        data-uk-toggle="target: .sc-toggle-login-password; animation: uk-animation-scale-up">Forgot
                                        Password?</a></div>
                            </div>
                            <div class="uk-margin-large-top">
                                <button class="sc-button sc-button-large sc-button-block sc-button-danger" type="submit">Sign In</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="sc-password-form" class="sc-toggle-login-password" hidden>
                    <div class="sc-login-page-inner">
                        <div class="uk-margin-medium">
                            Please enter your email address. You will receive a link to reset your password.
                        </div>
                        <form action="bikin-reset-form.html">
                            <div class="uk-margin-medium">
                                <label for="sc-reset-email">Email</label>
                                <input id="sc-reset-email" type="text" class="uk-input" data-sc-input>
                            </div>
                            <div class="uk-margin-large-top">
                                <button type="submit"
                                    class="sc-button sc-button-large sc-button-block sc-button-primary">Reset
                                    Password</button>
                                <div class="uk-margin-large-top uk-flex uk-flex-middle uk-flex-center">
                                    <a href="#" class="sc-text-semibold"
                                        data-uk-toggle="target: .sc-toggle-login-password; animation: uk-animation-scale-up">Back
                                        to login form</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
