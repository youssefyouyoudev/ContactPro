@php($isEdit = isset($contact))

<div class="row g-3">
    <div class="col-12">
        <label class="form-label fw-semibold">Name</label>
        <input type="text" name="name" value="{{ old('name', $contact->name ?? '') }}" required class="form-control">
        @error('name')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Email</label>
        <input type="email" name="email" value="{{ old('email', $contact->email ?? '') }}" class="form-control">
        @error('email')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $contact->phone ?? '') }}" class="form-control">
        @error('phone')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Stage</label>
        <select name="stage" class="form-select">
            @php($stages = ['lead' => 'Lead', 'prospect' => 'Prospect', 'customer' => 'Customer', 'partner' => 'Partner', 'vendor' => 'Vendor'])
            @foreach ($stages as $value => $label)
                <option value="{{ $value }}" @selected(old('stage', $contact->stage ?? 'lead') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('stage')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Job title</label>
        <input type="text" name="job_title" value="{{ old('job_title', $contact->job_title ?? '') }}" class="form-control">
        @error('job_title')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Source</label>
        <input type="text" name="source" value="{{ old('source', $contact->source ?? '') }}" class="form-control">
        @error('source')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tags (comma-separated)</label>
        <input type="text" name="tags" value="{{ old('tags', $contact->tags ?? '') }}" class="form-control">
        @error('tags')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Last contacted</label>
        <input type="datetime-local" name="last_contacted_at" value="{{ old('last_contacted_at', optional($contact->last_contacted_at ?? null)->format('Y-m-d\TH:i')) }}" class="form-control">
        @error('last_contacted_at')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Company</label>
        <input type="text" name="company" value="{{ old('company', $contact->company ?? '') }}" class="form-control">
        @error('company')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Address</label>
        <input type="text" name="address" value="{{ old('address', $contact->address ?? '') }}" class="form-control">
        @error('address')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Notes</label>
        <textarea name="notes" rows="4" class="form-control">{{ old('notes', $contact->notes ?? '') }}</textarea>
        @error('notes')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 d-flex align-items-center gap-2">
        <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Update contact' : 'Save contact' }}</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</div>
