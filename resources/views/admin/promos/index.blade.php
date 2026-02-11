@extends('layouts.admin')
@section('title', 'Promos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Promo</h3>
    <a href="{{ route('promos.create') }}" class="btn btn-primary">Tambah Promo</a>
</div>

<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tenant</th>
            <th>Nama Promo</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($promos as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->tenant->nama_tenant ?? '-' }}</td>
                <td>{{ $p->nama_promo }}</td>
                <td>{{ $p->tanggal_mulai }}</td>
                <td>{{ $p->tanggal_selesai }}</td>
                <td>
                    @if ($p->gambar)
                        <img src="{{ asset('storage/'.$p->gambar) }}" alt="gambar promo" width="60">
                    @endif
                </td>
                <td>
                    <a href="{{ route('promos.edit',$p->id_promo) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit</a>
                    <button class="btn btn-danger btn-sm btn-delete" data-url="{{ route('promos.destroy', $p->id_promo) }}">
                        <i class="bi bi-trash-fill"></i> Delete
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
@endsection