@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <p class="text-secondary mb-1 small">People, leads, suppliers</p>
        <h1 class="h3 fw-bold mb-0">Contacts</h1>
    </div>
    <a href="{{ route('contacts.create') }}" class="btn btn-primary">+ Add contact</a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Search</label>
                <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Name, email, phone, company" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Company</label>
                <select name="company" class="form-select">
                    <option value="">All</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company }}" @selected(($filters['company'] ?? '') === $company)>{{ $company }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Month</label>
                <select name="month" class="form-select">
                    <option value="">Any</option>
                    @foreach (range(1, 12) as $month)
                        <option value="{{ $month }}" @selected(($filters['month'] ?? '') == $month)>{{ \Carbon\Carbon::create()->month($month)->format('F') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">From</label>
                <input type="date" name="from" value="{{ $filters['from'] ?? '' }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">To</label>
                <input type="date" name="to" value="{{ $filters['to'] ?? '' }}" class="form-control">
            </div>
            <div class="col-md-6 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Apply</button>
                <a href="{{ route('contacts.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <p class="text-secondary mb-1 small">Bulk import</p>
                <h2 class="h5 fw-bold mb-0">Upload Excel or CSV</h2>
            </div>
            <form action="{{ route('contacts.import') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-wrap gap-2 align-items-center">
                @csrf
                <input type="file" name="file" accept=".xlsx,.xls,.csv" class="form-control" required style="max-width: 260px;">
                <button type="submit" class="btn btn-primary">Import</button>
            </form>
        </div>
        <p class="text-secondary small mb-0">Expected columns: Name, Email, Phone, Company, Address, Notes. Existing contacts are updated when email or phone matches.</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr class="text-secondary text-uppercase small">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Stage</th>
                    <th>Last contacted</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $contact)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $contact->name }}</div>
                            <div class="text-secondary small">Added {{ $contact->created_at->diffForHumans() }}</div>
                        </td>
                        <td>{{ $contact->email ?? '—' }}</td>
                        <td>{{ $contact->phone ?? '—' }}</td>
                        <td>{{ $contact->company ?? '—' }}</td>
                        <td><span class="badge text-bg-secondary text-uppercase">{{ $contact->stage ?? 'lead' }}</span></td>
                        <td>{{ optional($contact->last_contacted_at)->format('Y-m-d H:i') ?? '—' }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Delete this contact?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-secondary py-4">No contacts found. Try adjusting your filters.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $contacts->links() }}
</div>
@endsection
