@extends('layouts.admin')
@section('title', isset($profile) ? 'Edit Profile' : 'Tambah Profile')

@section('content')
<h3>{{ isset($profile) ? 'Edit' : 'Tambah' }} Profile Mall</h3>

<form method="POST" enctype="multipart/form-data"action="{{ isset($profile) ? route('profiles.update', $profile->id_profile) : route('profiles.store') }}">
    @csrf
    @if (isset($profile)) 
     @method('PUT')
    @endif

    <div class="mb-3">
        <label>Nama Mall</label>
        <input type="text" name="nama_mall" class="form-control"
            value="{{ old('nama_mall', $profile->nama_mall ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $profile->deskripsi ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Gambar</label>
        <input type="file" name="gambar" class="form-control">
        @if (isset($profile) && $profile->gambar)
            <img src="{{ asset('storage/'.$profile->gambar) }}" alt="gambar mall" width="100" class="mt-2">
        @endif
    </div>

    <button type="submit" class="btn btn-success">{{ isset($profile) ? 'Update' : 'Simpan' }}</button>
    <a href="{{ route('profiles.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection