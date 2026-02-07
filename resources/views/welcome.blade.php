@extends('layouts.app')

@section('content')
<div class="row align-items-center g-5">
    <div class="col-lg-6">
        <span class="badge text-bg-primary mb-3">Welcome to ContactPro</span>
        <h1 class="display-5 fw-bold">Organize every relationship in one place.</h1>
        <p class="fs-5 text-secondary">Secure, fast, and built on Laravel. Create pipelines, capture notes, and keep your team in sync with effortless light/dark theming.</p>
        <div class="d-flex flex-wrap gap-2 mt-3">
            <a class="btn btn-primary btn-lg" href="{{ route('register') }}">Create account</a>
            <a class="btn btn-outline-secondary btn-lg" href="{{ route('login') }}">Sign in</a>
            <a class="btn btn-link" href="{{ route('landing') }}">See product tour</a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="mb-1">Contacts snapshot</h5>
                        <small class="text-secondary">Preview of how your workspace looks.</small>
                    </div>
                    <span class="badge text-bg-primary">Live demo</span>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr class="text-secondary text-uppercase small">
                                <th>Name</th>
                                <th>Company</th>
                                <th>Phone</th>
                                <th class="text-end">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-semibold">Amelia Stone</td>
                                <td>Northwind</td>
                                <td>+1 202 555 0183</td>
                                <td class="text-end"><span class="badge text-bg-primary">Hot</span></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Liam Patel</td>
                                <td>Segmentify</td>
                                <td>+44 7700 900321</td>
                                <td class="text-end"><span class="badge text-bg-secondary">Follow-up</span></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Chloe Kim</td>
                                <td>Nova Labs</td>
                                <td>+1 415 555 0122</td>
                                <td class="text-end"><span class="badge text-bg-secondary">Renewal</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 d-flex gap-2">
                    <button class="btn btn-primary">Add contact</button>
                    <button class="btn btn-outline-secondary">Import CSV</button>
                    <button class="btn btn-outline-secondary">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
