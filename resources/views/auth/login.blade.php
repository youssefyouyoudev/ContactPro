@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary fw-bold mb-3" style="width: 3rem; height: 3rem;">
                            CP
                        </div>
                        <h1 class="h4 fw-bold mb-1">Welcome back</h1>
                        <p class="text-secondary mb-0">Sign in to manage your contacts securely.</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <div class="fw-semibold mb-1">We couldn't sign you in</div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control">
                            <div class="invalid-feedback">Please enter your email.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input id="password" type="password" name="password" required class="form-control">
                            <div class="invalid-feedback">Please enter your password.</div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="fw-semibold" href="{{ route('password.request') }}">Forgot your password?</a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Sign in</button>
                    </form>

                    <p class="text-center text-secondary mt-4 mb-0">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="fw-semibold">Create one</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
