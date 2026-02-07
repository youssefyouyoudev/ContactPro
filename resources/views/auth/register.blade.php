@extends('layouts.app')

@section('content')
<style>
    .plan-card {
        cursor: pointer;
        border: 1px solid var(--bs-border-color);
        transition: all 0.2s ease;
        position: relative;
    }
    .plan-card input[type="radio"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }
    .plan-card.active {
        border-color: var(--bs-primary);
        box-shadow: 0 18px 40px rgba(0, 95, 153, 0.15);
        transform: translateY(-2px);
    }
    .plan-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.65rem;
        border-radius: 999px;
        background: rgba(0, 95, 153, 0.08);
        color: var(--bs-primary);
        font-weight: 600;
        font-size: 0.85rem;
    }
    .pill { padding: 0.35rem 0.8rem; border-radius: 999px; }
    .benefit-dot { width: 10px; height: 10px; border-radius: 50%; background: var(--bs-primary); opacity: 0.25; }
</style>

<div class="row g-4 align-items-start">
    <div class="col-lg-8">
        <div class="card border-0 shadow-lg overflow-hidden">
            <div class="card-body p-4 p-lg-5">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary-subtle text-primary fw-bold d-inline-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">CP</div>
                        <div>
                            <span class="pill bg-primary-subtle text-primary fw-semibold">Step 1 of 2</span>
                            <h1 class="h4 fw-bold mt-2 mb-1">Create your workspace</h1>
                            <p class="text-secondary small mb-0">Fast signup, flexible plans, and no card required to start.</p>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="pill bg-body-secondary text-secondary fw-semibold">Secure checkout</span>
                        <div class="text-secondary small">AES-256 & SSO ready</div>
                    </div>
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
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="name">Full name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control">
                            <div class="invalid-feedback">Please enter your name.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="email">Work email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-control" placeholder="name@company.com">
                            <div class="invalid-feedback">Please enter a valid email.</div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="fw-semibold mb-0">Choose your plan</p>
                            <span class="text-secondary small">Change anytime</span>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="plan-card card h-100 p-3" data-plan-card data-label="Starter" data-price="Free" data-tagline="Unlimited contacts, basics">
                                    <input type="radio" name="plan" value="starter" {{ old('plan', 'growth') === 'starter' ? 'checked' : '' }}>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge text-bg-secondary">Starter</span>
                                        <span class="badge text-bg-light border">Free forever</span>
                                    </div>
                                    <div class="h4 fw-bold mb-1">0 DH</div>
                                    <small class="text-secondary">Unlimited contacts, basic pipelines.</small>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="plan-card card h-100 p-3" data-plan-card data-label="Growth" data-price="190 DH/month" data-tagline="Automations, permissions, SLA timers">
                                    <input type="radio" name="plan" value="growth" {{ old('plan', 'growth') === 'growth' ? 'checked' : '' }}>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="plan-chip">Growth</span>
                                        <span class="badge bg-primary-subtle text-primary">Popular</span>
                                    </div>
                                    <div class="h4 fw-bold mb-1">190 DH</div>
                                    <small class="text-secondary">Automations, permissions, SLA timers.</small>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="plan-card card h-100 p-3" data-plan-card data-label="Scale" data-price="Talk to sales" data-tagline="SSO, audit logs, premium support">
                                    <input type="radio" name="plan" value="scale" {{ old('plan') === 'scale' ? 'checked' : '' }}>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge text-bg-secondary">Scale</span>
                                        <span class="badge text-bg-light border">Enterprise</span>
                                    </div>
                                    <div class="h4 fw-bold mb-1">Custom</div>
                                    <small class="text-secondary">SSO, audit logs, premium support.</small>
                                </label>
                            </div>
                        </div>
                        <div class="alert alert-primary d-flex align-items-center gap-2 mt-3 mb-0">
                            <span class="badge bg-primary">New</span>
                            <div class="small mb-0">You can swap plans after signup. Pricing is monthly and billed only after trial.</div>
                        </div>
                    </div>

                    <div class="row g-3 mt-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" required class="form-control" autocomplete="new-password">
                                <button class="btn btn-outline-secondary" type="button" id="toggle-password">Show</button>
                            </div>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar" role="progressbar" id="password-strength" style="width: 0%;"></div>
                            </div>
                            <div class="invalid-feedback">Please enter a password.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="password_confirmation">Confirm password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control" autocomplete="new-password">
                            <div class="invalid-feedback">Please confirm your password.</div>
                        </div>
                    </div>

                    <div class="card bg-body-secondary bg-opacity-25 border-0 mt-4 mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">Checkout summary</div>
                                <small class="text-secondary" id="plan-summary">Growth · 190 DH/month · Change anytime</small>
                            </div>
                            <div class="text-end">
                                <div class="h5 fw-bold mb-0" id="price-summary">190 DH</div>
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

    <div class="col-lg-4">
        <div class="d-flex flex-column gap-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-uppercase text-secondary small mb-3">Why teams choose ContactPro</h6>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex gap-3">
                            <span class="benefit-dot mt-1"></span>
                            <div>
                                <div class="fw-semibold">Onboard in minutes</div>
                                <div class="text-secondary small">Import contacts, sync email, and share access instantly.</div>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <span class="benefit-dot mt-1"></span>
                            <div>
                                <div class="fw-semibold">Pipeline clarity</div>
                                <div class="text-secondary small">Stages, owners, and last-contact dates stay aligned across the team.</div>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <span class="benefit-dot mt-1"></span>
                            <div>
                                <div class="fw-semibold">Stay secure</div>
                                <div class="text-secondary small">Role-based permissions, audit-ready exports, and data residency controls.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="fw-semibold">Need a hand?</div>
                        <div class="text-secondary small">24/7 chat and onboarding calls for new workspaces.</div>
                    </div>
                    <a href="mailto:support@contactpro.test" class="btn btn-outline-primary btn-sm">Talk to us</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (() => {
        const cards = document.querySelectorAll('[data-plan-card]');
        const planSummary = document.getElementById('plan-summary');
        const priceSummary = document.getElementById('price-summary');
        const password = document.getElementById('password');
        const togglePassword = document.getElementById('toggle-password');
        const strengthBar = document.getElementById('password-strength');

        const applyActive = () => {
            cards.forEach((card) => {
                const input = card.querySelector('input[type="radio"]');
                card.classList.toggle('active', input.checked);
                if (input.checked) {
                    planSummary.textContent = `${card.dataset.label} · ${card.dataset.price} · ${card.dataset.tagline}`;
                    priceSummary.textContent = card.dataset.price === 'Talk to sales' ? 'Custom' : card.dataset.price;
                }
            });
        };

        cards.forEach((card) => {
            const input = card.querySelector('input[type="radio"]');
            const handleChange = () => applyActive();
            input.addEventListener('change', handleChange);
            card.addEventListener('click', () => {
                input.checked = true;
                input.dispatchEvent(new Event('change'));
            });
        });
        applyActive();

        if (togglePassword && password) {
            togglePassword.addEventListener('click', () => {
                const nextType = password.type === 'password' ? 'text' : 'password';
                password.type = nextType;
                togglePassword.textContent = nextType === 'password' ? 'Show' : 'Hide';
            });
        }

        const evaluateStrength = (value) => {
            let score = 0;
            if (value.length >= 8) score += 25;
            if (/[A-Z]/.test(value)) score += 25;
            if (/[0-9]/.test(value)) score += 25;
            if (/[^A-Za-z0-9]/.test(value)) score += 25;
            return score;
        };

        if (password && strengthBar) {
            password.addEventListener('input', (e) => {
                const score = evaluateStrength(e.target.value);
                strengthBar.style.width = `${score}%`;
                strengthBar.classList.remove('bg-danger', 'bg-warning', 'bg-success');
                if (score < 50) strengthBar.classList.add('bg-danger');
                else if (score < 75) strengthBar.classList.add('bg-warning');
                else strengthBar.classList.add('bg-success');
            });
        }
    })();
</script>
@endsection
