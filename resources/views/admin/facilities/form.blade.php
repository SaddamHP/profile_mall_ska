@extends('layouts.admin')
@section('title', isset($facility) ? 'Edit Fasilitas' : 'Tambah Fasilitas')

@section('content')
<h3>{{ isset($facility) ? 'Edit' : 'Tambah' }} Fasilitas</h3>
<form method="POST" enctype="multipart/form-data" action="{{ isset($facility) ? route('facilities.update', $facility->id_facility) : route('facilities.store') }}">
    @csrf
    @if (isset($facility))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Nama Fasilitas</label>
        <input type="text" name="nama_facility" class="form-control" value="{{ old('nama_facility', $facility->nama_facility ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Lantai</label>
        <select name="id_floor" class="form-select" required>
            <option value="">-- Pilih Lantai --</option>
            @foreach ($floors as $f)
                <option value="{{ $f->id_floor }}" {{ old('id_floor', $facility->id_floor ?? '') == $f->id_floor ? 'selected' : '' }}>
                    {{ $f->lantai }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $facility->deskripsi ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Foto</label>
        <input type="file" name="foto" class="form-control">
        @if (isset($facility) && $facility->foto)
            <img src="{{ asset('storage/'.$facility->foto) }}" alt="gambar fasilitas" width="100" class="mt-2">
        @endif
    </div>

    <button type="submit" class="btn btn-success">{{ isset($facility) ? 'Update' : 'Simpan' }}</button>
    <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection