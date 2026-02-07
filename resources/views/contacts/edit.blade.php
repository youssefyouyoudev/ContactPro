@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <p class="text-secondary mb-1 small">Update details</p>
        <h1 class="h3 fw-bold mb-0">Edit contact</h1>
    </div>
    <a href="{{ route('contacts.index') }}" class="btn btn-outline-secondary">Back</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('contacts.update', $contact) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            @include('contacts._form', ['contact' => $contact])
        </form>
    </div>
</div>
@endsection
