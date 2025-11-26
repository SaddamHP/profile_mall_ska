@extends('layouts.admin')
@section('title', isset($promo) ? 'Edit Promo' : 'Tambah Promo')

@section('content')
<h3>{{ isset($promo) ? 'Edit' : 'Tambah' }} Promo</h3>

<form method="POST" action="{{ isset($promo) ? route('promos.update', $promo->id_promo) : route('promos.store') }}" enctype="multipart/form-data">
    @csrf
    @if (isset($promo))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Tenant</label>
        <select name="id_tenant" class="form-select" required>
            <option value="">-- Pilih Tenant --</option>
            @foreach ($tenants as $t)
                <option value="{{ $t->id_tenant }}" {{ old('id_tenant', $promo->id_tenant ?? '') == $t->id_tenant ? 'selected' : '' }}>
                    {{ $t->nama_tenant }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Nama Promo</label>
        <input type="text" name="nama_promo" class="form-control" value="{{ old('nama_promo', $promo->nama_promo ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Tanggal Mulai</label>
        <input type="datetime-local" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $promo->tanggal_mulai ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Tanggal Selesai</label>
        <input type="datetime-local" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $promo->tanggal_selesai ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Gambar</label>
        <input type="file" name="gambar" class="form-control">
        @if (isset($promo) && $promo->gambar)
            <img src="{{ asset('storage/'.$promo->gambar) }}" alt="gambar promo" width="100" class="mt-2">
        @endif
    </div>

    <button type="submit" class="btn btn-success">{{ isset($promo) ? 'Update' : 'Simpan' }}</button>
    <a href="{{ route('promos.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection