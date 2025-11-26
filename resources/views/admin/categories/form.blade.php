@extends('layouts.admin')
@section('title', isset($category) ? 'Edit Kategori' : 'Tambah Kategori')

@section('content')
<h3>{{ isset($category) ? 'Edit' : 'Tambah' }} Kategori</h3>

<form action="{{ isset($category) ? route('categories.update', $category->id_category) : route('categories.store') }}" method="POST">
    @csrf
    @if (isset($category))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text" name="nama_category" class="form-control" value="{{ old('nama_category', $category->nama_category ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deksripsi" class="form-control" rows="3">{{ old('deskripsi', $category->deskripsi ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">{{ isset($category) ? 'Update' : 'Simpan' }}</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection