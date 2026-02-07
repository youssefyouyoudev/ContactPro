@extends('layouts.app')

@section('content')
@php($demoContacts = [
    ['name' => 'Amelia Stone', 'company' => 'Northwind', 'phone' => '+1 202 555 0183', 'notes' => 'Requested onboarding deck', 'score' => '92'],
    ['name' => 'Liam Patel', 'company' => 'Segmentify', 'phone' => '+44 7700 900321', 'notes' => 'Champions self-serve rollout', 'score' => '88'],
    ['name' => 'Chloe Kim', 'company' => 'Nova Labs', 'phone' => '+1 415 555 0122', 'notes' => 'Renewal due next month', 'score' => '81'],
])

<div class="row g-5 align-items-center mb-5">
    <div class="col-lg-6">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-3">
            <span class="badge rounded-pill bg-primary"></span>
            New: Pipelines and lightning-fast search
        </div>
        <h1 class="display-5 fw-bold mb-3">The contact manager that feels built for your team.</h1>
        <p class="fs-5 text-secondary mb-4">Keep every relationship organized with search, filters, and notes that never get lost. Built on Laravel for teams that care about speed, privacy, and control.</p>
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Create free account</a>
            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">Sign in</a>
        </div>
        <div class="row g-3">
            <div class="col-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="h3 fw-bold mb-1">99.9%</div>
                        <small class="text-secondary">Uptime backed by Laravel</small>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="h3 fw-bold mb-1">3x</div>
                        <small class="text-secondary">Faster contact lookup</small>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="h3 fw-bold mb-1">GDPR</div>
                        <small class="text-secondary">Data ownership ready</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="mb-0">Pipeline snapshot</h5>
                        <small class="text-secondary">Search, filter, and act in one place.</small>
                    </div>
                    <span class="badge text-bg-primary">Sample data only</span>
                </div>
                <div class="d-flex gap-2 mb-3">
                    <input type="text" class="form-control" placeholder="Search contacts">
                    <button class="btn btn-primary">Add contact</button>
                </div>
                <div class="table-responsive mb-3">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr class="small text-uppercase text-secondary">
                                <th>Name</th>
                                <th>Company</th>
                                <th>Phone</th>
                                <th>Notes</th>
                                <th class="text-end">Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($demoContacts as $row)
                                <tr>
                                    <td class="fw-semibold">{{ $row['name'] }}</td>
                                    <td>{{ $row['company'] }}</td>
                                    <td>{{ $row['phone'] }}</td>
                                    <td class="text-secondary">{{ $row['notes'] }}</td>
                                    <td class="text-end fw-semibold text-primary">{{ $row['score'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row g-2">
                    <div class="col-4"><div class="p-2 bg-primary-subtle rounded text-primary fw-semibold">Search + Filters</div></div>
                    <div class="col-4"><div class="p-2 bg-primary-subtle rounded text-primary fw-semibold">Notes + Activity</div></div>
                    <div class="col-4"><div class="p-2 bg-secondary-subtle rounded text-secondary fw-semibold">Exports + Imports</div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="py-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <span class="badge text-bg-primary mb-2">Workflows</span>
                    <h3 class="h5 fw-bold">Pipeline automation</h3>
                    <p class="text-secondary">Move contacts between stages with one click, auto-assign owners, and keep notes threaded for the entire team.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <span class="badge text-bg-secondary mb-2">Collaboration</span>
                    <h3 class="h5 fw-bold">Shared inbox feel</h3>
                    <p class="text-secondary">Comment, mention teammates, and keep context tied to every interaction across email, calls, and meetings.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <span class="badge text-bg-primary mb-2">Security</span>
                    <h3 class="h5 fw-bold">Audit-ready controls</h3>
                    <p class="text-secondary">Role-based access, activity trails, and export controls keep your customer data safe and compliant.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-body-secondary bg-opacity-10 rounded-4 px-4">
    <div class="row g-4 align-items-center">
        <div class="col-lg-5">
            <h2 class="fw-bold mb-3">Built like a SaaS, priced for teams.</h2>
            <p class="text-secondary mb-4">Start free, scale when your team grows. All plans include unlimited contacts, activity timelines, and lightning-fast search.</p>
            <ul class="list-unstyled text-secondary mb-0">
                <li class="d-flex align-items-start gap-2 mb-2"><span class="badge bg-primary-subtle text-primary">1</span><span>Unlimited contacts with CSV import and export.</span></li>
                <li class="d-flex align-items-start gap-2 mb-2"><span class="badge bg-primary-subtle text-primary">2</span><span>Shared pipelines, tags, and custom fields.</span></li>
                <li class="d-flex align-items-start gap-2"><span class="badge bg-primary-subtle text-primary">3</span><span>API-first, secure by default, with audit logs.</span></li>
            </ul>
        </div>
        <div class="col-lg-7">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex flex-column">
                            <span class="badge text-bg-secondary align-self-start mb-3">Starter</span>
                            <div class="display-6 fw-bold mb-2">Free</div>
                            <p class="text-secondary flex-grow-1">Unlimited contacts, notes, and basic pipelines for small teams.</p>
                            <button class="btn btn-outline-secondary mt-2">Get started</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-lg border-primary" style="border-width:2px;">
                        <div class="card-body d-flex flex-column">
                            <span class="badge text-bg-primary align-self-start mb-3">Growth</span>
                            <div class="display-6 fw-bold mb-2">190 DH</div>
                            <p class="text-secondary flex-grow-1">Advanced filters, team permissions, automations, and SLA timers.</p>
                            <button class="btn btn-primary mt-2">Try Growth</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex flex-column">
                            <span class="badge text-bg-secondary align-self-start mb-3">Scale</span>
                            <div class="display-6 fw-bold mb-2">Custom</div>
                            <p class="text-secondary flex-grow-1">Dedicated onboarding, SSO, audit logs, and premium support.</p>
                            <button class="btn btn-outline-secondary mt-2">Talk to sales</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="row g-4 align-items-center">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <span class="badge text-bg-primary mb-3">Live metrics</span>
                    <h3 class="fw-bold">Your pipeline, always current.</h3>
                    <p class="text-secondary">Track contact velocity, renewals, and follow-ups with built-in analytics and clear owner accountability.</p>
                    <ul class="list-unstyled text-secondary mb-0">
                        <li class="mb-2">- Stage conversion and time-in-stage breakdowns</li>
                        <li class="mb-2">- Renewal radar for upcoming contracts</li>
                        <li>- Activity heatmaps to catch quiet accounts early</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-0">Signals</h5>
                            <small class="text-secondary">Auto-sorted by urgency</small>
                        </div>
                        <span class="badge text-bg-secondary">Live</span>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">Renewal in 14 days</div>
                                <small class="text-secondary">Nova Labs · Owner: Chloe</small>
                            </div>
                            <span class="badge text-bg-primary">Hot</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">No touch in 10 days</div>
                                <small class="text-secondary">Segmentify · Owner: Liam</small>
                            </div>
                            <span class="badge text-bg-secondary">Follow-up</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">New lead captured</div>
                                <small class="text-secondary">Northwind · Owner: Amelia</small>
                            </div>
                            <span class="badge text-bg-primary">New</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
