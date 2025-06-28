
@extends('layout.app')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>
    <a href="{{ route('produk.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Produk</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $produk->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ (old('kategori_id', $produk->kategori_id) == $kategori->id) ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $produk->harga) }}" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok', $produk->stok) }}" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Produk</label>
            @if($produk->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}" width="100">
                </div>
            @endif
            <input type="file" name="gambar" id="gambar" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>