@extends('layouts.admin')
@section('title', isset($tenant) ? 'Edit Tenant' : 'Tambah Tenant')

@section('content')
<h3>{{ isset($tenant) ? 'Edit' : 'Tambah' }} Tenant</h3>

<form action="{{ isset($tenant) ? route('tenants.update', $tenant->id_tenant) : route('tenants.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (isset($tenant))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Nama Tenant</label>
        <input type="text" name="nama_tenant" class="form-control" value="{{ old('nama_tenant', $tenant->nama_tenant ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Kategori</label>
        <select name="id_category" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $c )
                <option value="{{ $c->id_category }}" {{ old('id_category', $tenant->id_category ?? '') == $c->id_category ? 'selected' : '' }}>
                    {{ $c->nama_category }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Lantai</label>
        <select name="id_floor" class="form-select" required>
            <option value="">-- Pilih Lantai --</option>
            @foreach ($floors as $f )
                <option value="{{ $f->id_floor }}" {{ old('id_floor', $tenant->id_floor ?? '') == $f->id_floor ? 'selected' : '' }}>
                    {{ $f->lantai }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Gambar</label>
        <input type="file" name="gambar" class="form-control">
        @if (isset($tenant) && $tenant->gambar)
            <img src="{{ asset('storage/'.$tenant->gambar) }}" alt="gambar tenant" width="100" class="mt-2">
        @endif
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $facility->deskripsi ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">{{ isset($tenant) ? 'Update' : 'Simpan' }}</button>
    <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection