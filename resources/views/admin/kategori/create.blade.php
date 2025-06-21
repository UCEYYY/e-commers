@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Kategori</h1>
</div>
<form action="{{ route('kategori.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Kategori</label>
        <input type="text" class="form-control" name="nama" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>

@endsection