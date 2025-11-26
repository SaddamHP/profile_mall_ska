@extends('layouts.admin')
@section('title', isset($floor) ? 'Edit Lantai' : 'Tambah Lantai')

@section('content')
<h3>{{ isset($floor) ? 'Edit' : 'Tambah' }} Lantai</h3>

<form method="POST" action="{{ isset($floor) ? route('floors.update', $floor->id_floor) : route('floors.store') }}">
    @csrf
    @if (isset($floor))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Nomor Lantai</label>
        <input type="text" name="lantai" class="form-control" value="{{ old('lantai', $floor->lantai ?? '') }}" required>
    </div>

    <button type="submit" class="btn btn-success">{{ isset($floor) ? 'Update' : 'Simpan' }}</button>
    <a href="{{ route('floors.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection