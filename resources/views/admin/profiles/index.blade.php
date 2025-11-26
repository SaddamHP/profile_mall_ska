@extends('layouts.admin')
@section('title', 'Profiles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Profile Mall</h3>
  <a href="{{ route('profiles.create') }}" class="btn btn-primary">Tambah Data</a>
</div>

<table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Nama Mall</th>
      <th>Deskripsi</th>
      <th>Gambar</th>
      <th>Aksi</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($profiles as $p )
      <tr>
        <td>{{ $p->id_profile }}</td>
        <td>{{ $p->nama_mall }}</td>
        <td>{{ Str::limit($p->deskripsi, 60) }}</td>
        <td>
          @if ($p->gambar)
            <img src="{{ asset('storage/'.$p->gambar) }}" alt="Gambar Mall" width="70">
          @endif
        </td>
        <td>
          <a href="{{ route('profiles.edit',$p->id_profile) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil-square"></i> Edit</a>
          <button class="btn btn-danger btn-sm btn-delete" data-url="{{ route('profiles.destroy', $p->id_profile) }}">
            <i class="bi bi-trash-fill"></i> Delete
          </button>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
@endsection