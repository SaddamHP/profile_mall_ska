@extends('layouts.admin')
@section('title', 'Events')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Event</h3>
    <a href="{{ route('events.create') }}" class="btn btn-primary">Tambah Event</a>
</div>

<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nama Event</th>
            <th>Lantai</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $e)
            <tr>
                <td>{{ $e->id_event }}</td>
                <td>{{ $e->nama_event }}</td>
                <td>{{ $e->floor->lantai ?? '-' }}</td>
                <td>{{ $e->tanggal_mulai }}</td>
                <td>{{ $e->tanggal_selesai }}</td>
                <td>
                    @if ($e->gambar)
                        <img src="{{ asset('storage/'.$e->id_event) }}" alt="gambar event" width="100">
                    @endif
                </td>
                <td>
                    <a href="{{ route('events.edit',$e->id_event) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit</a>
                    <button class="btn btn-danger btn-sm btn-delete" data-url="{{ route('events.destroy', $e->id_event) }}">
                        <i class="bi bi-trash-fill"></i> Delete
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
@endsection