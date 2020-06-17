@extends('layouts.common')

@section('content')
<div class="container">
    <div class="row justify-content-center @computer my-5 @endcomputer">
        <div class="col-md-8 @computer my-5 @endcomputer">
            <div class="card @computer my-5 @endcomputer">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form class="d-inline" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
					<div class="row">
						<div class="col-6">
							<a class="btn btn-block btn-social btn-facebook text-light" id="facebook-login" href="{{ route('social.callback', 'facebook') }}">
								<span class="fa fa-facebook"></span> Login with Facebook
							</a>
						</div>
						<div class="col-6">
							<a class="btn btn-block btn-social btn-google text-light" id="google-login"  href="{{ route('social.callback', 'google') }}">
								<span class="fa fa-google"></span> Login with Google
							</a>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-social/bootstrap-social.css') }}" />
@endsection
