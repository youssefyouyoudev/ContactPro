@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary fw-bold mb-3" style="width: 3rem; height: 3rem;">
                            CP
                        </div>
                        <h1 class="h4 fw-bold mb-1">Create your workspace</h1>
                        <p class="text-secondary mb-0">Secure, fast, and ready for your team.</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <div class="fw-semibold mb-1">Please fix the issues below</div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="name">Full name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control">
                            <div class="invalid-feedback">Please enter your name.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-control">
                            <div class="invalid-feedback">Please enter a valid email.</div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-semibold mb-2">Choose your plan</p>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="card h-100 shadow-sm border-0 position-relative p-3">
                                        <input class="form-check-input position-absolute top-0 end-0 m-3" type="radio" name="plan" value="starter" {{ old('plan', 'growth') === 'starter' ? 'checked' : '' }}>
                                        <span class="badge text-bg-secondary mb-2">Starter</span>
                                        <div class="h4 fw-bold mb-1">Free</div>
                                        <small class="text-secondary">Unlimited contacts, basic pipelines.</small>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="card h-100 shadow-lg border-primary position-relative p-3" style="border-width:2px;">
                                        <input class="form-check-input position-absolute top-0 end-0 m-3" type="radio" name="plan" value="growth" {{ old('plan', 'growth') === 'growth' ? 'checked' : '' }}>
                                        <span class="badge text-bg-primary mb-2">Growth</span>
                                        <div class="h4 fw-bold mb-1">190 DH</div>
                                        <small class="text-secondary">Automations, permissions, SLA timers.</small>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="card h-100 shadow-sm border-0 position-relative p-3">
                                        <input class="form-check-input position-absolute top-0 end-0 m-3" type="radio" name="plan" value="scale" {{ old('plan') === 'scale' ? 'checked' : '' }}>
                                        <span class="badge text-bg-secondary mb-2">Scale</span>
                                        <div class="h4 fw-bold mb-1">Custom</div>
                                        <small class="text-secondary">SSO, audit logs, premium support.</small>
                                    </label>
                                </div>
                            </div>
                            <div class="alert alert-primary d-flex align-items-center gap-2 mt-3 mb-0">
                                <span class="badge bg-primary">New</span>
                                <div class="small mb-0">You can change or cancel your plan anytime after signup. Pricing shown is monthly.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="password">Password</label>
                            <input type="password" id="password" name="password" required class="form-control">
                            <div class="invalid-feedback">Please enter a password.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="password_confirmation">Confirm password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control">
                            <div class="invalid-feedback">Please confirm your password.</div>
                        </div>

                        <div class="card bg-body-secondary bg-opacity-25 border-0 mb-3">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-semibold">Checkout summary</div>
                                    <small class="text-secondary">Growth · 190 DH/month · Change anytime</small>
                                </div>
                                <div class="text-end">
                                    <div class="h5 fw-bold mb-0">190 DH</div>
                                    <small class="text-secondary">Due today: 0 DH (trial)</small>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Create account</button>
                    </form>

                    <p class="text-center text-secondary mt-4 mb-0">
                        Already have an account?
                        <a href="{{ route('login') }}" class="fw-semibold">Log in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
