@extends('layouts.app')

@section('content')

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
     style="background:url('{{ asset('assets/images/big/auth-bg.jpg') }}') no-repeat center center;">
    <div class="auth-box row">
        <div class="col-lg-7 col-md-5 modal-bg-img"
             style="background-image: url('{{ asset('assets/images/big/3.jpg') }}');">
        </div>
        <div class="col-lg-5 col-md-7 bg-white">
            <div class="p-3">
                <div class="text-center">
                    <img src="{{ asset('assets/images/big/icon.png') }}" alt="wrapkit">
                </div>
                <h2 class="mt-3 text-center">Reset Password</h2>
                <p class="text-center">Enter your new password below to reset your account.</p>

                <!-- Laravel Reset Password Form -->
                <form method="POST" action="{{ route('password.update') }}" class="mt-4">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-dark" for="email">Email Address</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email"
                                       placeholder="Enter your email" value="{{ $email ?? old('email') }}" required autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-dark" for="password">New Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password"
                                       placeholder="Enter new password" required>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-dark" for="password-confirm">Confirm Password</label>
                                <input class="form-control" id="password-confirm" type="password" name="password_confirmation"
                                       placeholder="Confirm new password" required>
                            </div>
                        </div>

                        <div class="col-lg-12 text-center mt-3">
                            <button type="submit" class="btn btn-block btn-dark">Reset Password</button>
                        </div>

                        <div class="col-lg-12 text-center mt-3">
                            <a href="{{ route('login') }}" class="text-danger">Back to Login</a>
                        </div>
                    </div>
                </form>
                <!-- End Reset Password Form -->

            </div>
        </div>
    </div>
</div>

@endsection
``
