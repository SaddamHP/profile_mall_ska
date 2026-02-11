@extends('layouts.admin')
@section('title', 'Contacts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Kontak</h3>
    <a href="{{ route('contacts.create') }}" class="btn btn-primary">Tambah Data</a>
</div>

<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Profile</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contacts as $c)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $c->profile->nama_mall ?? '-' }}</td>
                <td>{{ $c->alamat }}</td>
                <td>{{ $c->telepon }}</td>
                <td>{{ $c->email }}</td>
                <td>
                    <a href="{{ route('contacts.edit',$c->id_contact) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit</a>
                    <button class="btn btn-danger btn-sm btn-delete" data-url="{{ route('contacts.destroy', $c->id_contact) }}">
                        <i class="bi bi-trash-fill"></i> Delete
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
@endsection