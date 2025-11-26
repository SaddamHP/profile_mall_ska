@extends('layouts.admin')
@section('title', 'Tenants')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Tenant</h3>
  <a href="{{ route('tenants.create') }}" class="btn btn-primary">Tambah Tenant</a>
</div>

<table class="table table-stripped">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Nama Tenant</th>
      <th>Kategori</th>
      <th>Lantai</th>
      <th>Gambar</th>
      <th>Deskripsi</th>
      <th>Aksi</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($tenants as $t)
      <tr>
        <td>{{ $t->id_tenant }}</td>
        <td>{{ $t->nama_tenant }}</td>
        <td>{{ $t->category->nama_category ?? '-' }}</td>
        <td>{{ $t->floor->lantai ?? '-' }}</td>
        <td>@if ($t->gambar) <img src="{{ asset('storage/'.$t->gambar) }}" alt="gambar tenant" width="60"> @endif</td>
        <td>{{ Str::limit($t->deskripsi, 60) }}</td>
        <td>
          <a href="{{ route('tenants.edit',$t->id_tenant) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil-square"></i> Edit</a>
          <button class="btn btn-danger btn-sm btn-delete" data-url="{{ route('tenants.destroy', $t->id_tenant) }}">
            <i class="bi bi-trash-fill"></i> Delete
          </button>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
@endsection