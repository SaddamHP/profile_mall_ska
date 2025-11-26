@extends('layouts.admin')
@section('title', isset($contact) ? 'Edit Kontak' : 'Tambah Kontak')

@section('content')
<h3>{{ isset($contact) ? 'Edit' : 'Tambah' }} Kontak</h3>

<form method="POST" action="{{ isset($contact) ? route('contacts.update', $contact->id_contact) : route('contacts.store') }}">
    @csrf
    @if (isset($contact))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Profile Mall</label>
        <select name="id_profile" class="form-select" required>
            <option value="">-- Pilih Profile --</option>
            @foreach ($profiles as $p)
                <option value="{{ $p->id_profile }}" {{ old('id_profile', $contact->id_profile ?? '') == $p->id_profile ? 'selected' : '' }}>
                    {{ $p->nama_mall }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $contact->alamat ?? '') }}">
    </div>

    <div class="mb-3">
        <label>Telepon</label>
        <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $contact->telepon ?? '') }}">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $contact->email ?? '') }}">
    </div>

    <div class="mb-3">
        <label>Maps Embed</label>
        <textarea name="maps_embed" class="form-control" rows="3">{{ old('maps_embed', $contact->maps_embed ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">{{ isset($contact) ? 'Update' : 'Simpan' }}</button>
    <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection