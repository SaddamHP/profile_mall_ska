@extends('layouts.admin')
@section('title', isset($event) ? 'Edit Event' : 'Tambah Event')

@section('content')
<h3>{{ isset($event) ? 'Edit' : 'Tambah' }} Event Mall</h3>

<form method="POST" enctype="multipart/form-data" action="{{ isset($event) ? route('events.update', $event->id_event) : route('events.store') }}">
    @csrf
    @if (isset($event))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Nama Event</label>
        <input type="text" name="nama_event" class="form-control" value="{{ old('nama_event', $event->nama_event ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Lantai</label>
        <select name="id_floor" class="form-select" required>
            <option value="">-- Pilih Lantai --</option>
            @foreach ($floors as $f)
                <option value="{{ $f->id_floor }}" {{ old('id_floor', $event->id_floor ?? '') == $f->id_floor ? 'selected' : '' }}>
                    {{ $f->lantai }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Tanggal Mulai</label>
        <input type="datetime-local" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $event->tanggal_mulai ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Tanggal Selesai</label>
        <input type="datetime-local" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $event->tanggal_selesai ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $event->deskripsi ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Gambar</label>
        <input type="file" name="gambar" class="form-control">
        @if (isset($event) && $event->gambar)
            <img src="{{ asset('storage/'.$event->gambar) }}" alt="gambar event" width="100" class="mt-2">
        @endif
    </div>

    <button type="submit" class="btn btn-success">{{ isset($event) ? 'Update' : 'Simpan' }}</button>
    <a href="{{ route('events.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection