@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <p class="text-secondary mb-1 small">Add a new relationship</p>
        <h1 class="h3 fw-bold mb-0">Create contact</h1>
    </div>
    <a href="{{ route('contacts.index') }}" class="btn btn-outline-secondary">Back</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('contacts.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @include('contacts._form')
        </form>
    </div>
</div>
@endsection
