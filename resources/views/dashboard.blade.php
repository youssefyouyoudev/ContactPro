@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <p class="text-secondary mb-1 small">Overview</p>
        <h1 class="display-6 fw-bold mb-0">Dashboard</h1>
    </div>
    <a href="{{ route('contacts.create') }}" class="btn btn-success d-inline-flex align-items-center gap-2">
        <span class="fw-semibold">+ Add contact</span>
    </a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <p class="text-secondary small mb-1">Total contacts</p>
                <div class="fs-2 fw-bold">{{ $totalContacts }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <p class="text-secondary small mb-1">Added this month</p>
                <div class="fs-2 fw-bold">{{ $newThisMonth }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <p class="text-secondary small mb-1">Top company</p>
                <div class="fs-4 fw-bold">{{ optional($topCompanies->first())->company ?? '—' }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <p class="text-secondary small mb-1">Profile</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-bold">{{ auth()->user()->name ?? '—' }}</div>
                        <div class="text-secondary small">{{ auth()->user()->email ?? '—' }}</div>
                    </div>
                    <a href="{{ route('contacts.index') }}" class="btn btn-outline-secondary btn-sm">Manage</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <p class="text-secondary small mb-1">Subscription</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-bold">Plan: {{ $subscription->plan ?? 'Growth' }}</div>
                        <div class="text-secondary small">Status: {{ $subscription->status ?? 'active' }} · Renews: {{ $subscription->renews_at ?? '—' }}</div>
                    </div>
                    <a href="{{ route('contacts.index') }}" class="btn btn-primary btn-sm">Update</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h2 class="h5 mb-0">Contact growth</h2>
                    <span class="badge text-bg-primary">Live</span>
                </div>
                <p class="text-secondary small">Monthly net new contacts across your workspace.</p>
                <canvas id="contactsChart" height="160"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h2 class="h5 mb-0">Segments</h2>
                    <a href="{{ route('contacts.index') }}" class="small fw-semibold">View contacts</a>
                </div>
                <canvas id="segmentsChart" height="160"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 mb-0">Recent contacts</h2>
                    <a href="{{ route('contacts.index') }}" class="fw-semibold">View all</a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse ($recentContacts as $contact)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">{{ $contact->name }}</div>
                                <div class="text-secondary small">{{ $contact->company ?? 'No company' }}</div>
                            </div>
                            <span class="text-secondary small">{{ $contact->created_at->format('M j') }}</span>
                        </div>
                    @empty
                        <div class="text-secondary">No contacts yet. Add your first one.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h2 class="h5 mb-3">Companies</h2>
                <div class="list-group list-group-flush">
                    @forelse ($topCompanies as $company)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">{{ $company->company }}</span>
                            <span class="text-secondary small">{{ $company->total }} contacts</span>
                        </div>
                    @empty
                        <div class="text-secondary">No company data yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <div class="col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h2 class="h6 text-uppercase text-secondary mb-3">Quick actions</h2>
                <div class="d-grid gap-2">
                    <a href="{{ route('contacts.create') }}" class="btn btn-primary">Add contact</a>
                    <a href="{{ route('contacts.index') }}" class="btn btn-outline-secondary">Import CSV</a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Export segment</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 mb-0">Activity signals</h2>
                    <span class="badge text-bg-secondary">Auto-prioritized</span>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-semibold">Renewal approaching</div>
                            <small class="text-secondary">Nova Labs · Renewal in 14 days</small>
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
                            <div class="fw-semibold">New inbound lead</div>
                            <small class="text-secondary">Northwind · Assigned to Amelia</small>
                        </div>
                        <span class="badge text-bg-primary">New</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@endpush

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    (() => {
        const lineEl = document.getElementById('contactsChart');
        const doughnutEl = document.getElementById('segmentsChart');
        if (!lineEl || !doughnutEl || typeof Chart === 'undefined') return;

        const styles = getComputedStyle(document.documentElement);
        const primary = styles.getPropertyValue('--bs-primary')?.trim() || '#005f99';
        const secondary = styles.getPropertyValue('--bs-secondary')?.trim() || '#686c70';
        const grid = styles.getPropertyValue('--bs-border-color')?.trim() || '#e5e7eb';
        const text = styles.getPropertyValue('--bs-body-color')?.trim() || '#111827';

        const monthLabels = @json($chartMonths);
        const monthTotals = @json($chartTotals);
        const segmentLabels = @json($stageLabels);
        const segmentTotals = @json($stageTotals);

        new Chart(lineEl, {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Contacts',
                    data: monthTotals,
                    borderColor: primary,
                    backgroundColor: primary,
                    tension: 0.35,
                    fill: false,
                    pointRadius: 4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: primary,
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    x: {
                        grid: { color: grid },
                        ticks: { color: text }
                    },
                    y: {
                        grid: { color: grid },
                        ticks: { color: text, precision: 0, stepSize: 5 }
                    }
                }
            }
        });

        new Chart(doughnutEl, {
            type: 'doughnut',
            data: {
                labels: segmentLabels,
                datasets: [{
                    data: segmentTotals,
                    backgroundColor: [primary, secondary, '#94a3b8', '#cbd5e1'],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: { legend: { position: 'bottom', labels: { color: text } } }
            }
        });
    })();
</script>
@endsection
