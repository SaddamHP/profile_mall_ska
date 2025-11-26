@extends('layouts.admin')
@section('title', 'Facilities')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Fasilitas Mall</h3>
    <a href="{{ route('facilities.create') }}" class="btn btn-primary">Tambah Fasilitas</a>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nama Fasilitas</th>
            <th>Lantai</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($facilities as $f)
            <tr>
                <td>{{ $f->id_facility }}</td>
                <td>{{ $f->nama_facility }}</td>
                <td>{{ $f->floor->lantai }}</td>
                <td>{{ Str::limit($f->deskripsi, 60) }}</td>
                <td>
                    @if ($f->foto)
                        <img src="{{ asset('storage/'.$f->foto) }}" alt="gambar fasilitas" width="70">
                    @endif
                </td>
                <td>
                    <a href="{{ route('facilities.edit',$f->id_facility) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit</a>
                    <button class="btn btn-danger btn-sm btn-delete" data-url="{{ route('facilities.destroy', $f->id_facility) }}">
                        <i class="bi bi-trash-fill"></i> Delete
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
@endsection