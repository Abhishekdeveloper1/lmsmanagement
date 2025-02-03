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
                <h2 class="mt-3 text-center">Confirm Password</h2>
                <p class="text-center">Please confirm your password before continuing.</p>

                <!-- Laravel Confirm Password Form -->
                <form method="POST" action="{{ route('password.confirm') }}" class="mt-4">
                    @csrf

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-dark" for="password">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password"
                                       placeholder="Enter your password" required>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 text-center mt-3">
                            <button type="submit" class="btn btn-block btn-dark">Confirm Password</button>
                        </div>

                        @if (Route::has('password.request'))
                        <div class="col-lg-12 text-center mt-3">
                            <a href="{{ route('password.request') }}" class="text-danger">Forgot Your Password?</a>
                        </div>
                        @endif
                    </div>
                </form>
                <!-- End Confirm Password Form -->

            </div>
        </div>
    </div>
</div>

@endsection
