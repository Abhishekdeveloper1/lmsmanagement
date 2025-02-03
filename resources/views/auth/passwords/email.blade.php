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
                <h2 class="mt-3 text-center">Forgot Password</h2>
                <p class="text-center">Enter your email address to receive a password reset link.</p>

                <!-- Laravel Forgot Password Form -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="mt-4" method="POST" action="{{ route('password.email') }}">
                    @csrf  <!-- CSRF token for security -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-dark" for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email"
                                       placeholder="Enter your email" value="{{ old('email') }}" required autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 text-center mt-3">
                            <button type="submit" class="btn btn-block btn-dark">Send Password Reset Link</button>
                        </div>

                        <div class="col-lg-12 text-center mt-3">
                            <a href="{{ route('login') }}" class="text-danger">Back to Login</a>
                        </div>
                    </div>
                </form>
                <!-- End Forgot Password Form -->

            </div>
        </div>
    </div>
</div>

@endsection
