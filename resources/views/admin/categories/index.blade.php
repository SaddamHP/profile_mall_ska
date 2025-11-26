@extends('layouts.admin')
@section('title', 'categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Kategori</h3>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Tambah Data</a>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <th>ID</th>
        <th>Kategori</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        @foreach ($categories as $c)
            <tr>
                <td>{{ $c->id_category }}</td>
                <td>{{ $c->nama_category }}</td>
                <td>{{ Str::limit($c->deskripsi, 70) }}</td>
                <td>
                    <a href="{{ route('categories.edit',$c->id_category) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit</a>
                    <button class="btn btn-danger btn-sm btn-delete" data-url="{{ route('categories.destroy', $c->id_category) }}">
                        <i class="bi bi-trash-fill"></i> Delete
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
@endsection