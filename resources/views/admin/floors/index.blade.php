@extends('layouts.admin')
@section('title', 'floors')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Lantai Mall</h3>
    <a href="{{ route('floors.create') }}" class="btn btn-primary">Tambah Lantai</a>
</div>

<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Lantai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($floors as $f)
            <tr>
                <td>{{ $f->id_floor }}</td>
                <td>{{ $f->lantai }}</td>
                <td>
                    <a href="{{ route('floors.edit',$f->id_floor) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit</a>
                    <button class="btn btn-danger btn-sm btn-delete" data-url="{{ route('floors.destroy', $f->id_floor) }}">
                        <i class="bi bi-trash-fill"></i> Delete
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
@endsection