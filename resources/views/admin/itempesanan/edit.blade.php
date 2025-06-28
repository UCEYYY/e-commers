
@extends('layout.app')

@section('content')
<div class="container">
    <h1>Edit Item Pesanan</h1>
    <a href="{{ route('itempesanan.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('itempesanan.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="pesanan_id" class="form-label">Pesanan</label>
            <select name="pesanan_id" id="pesanan_id" class="form-control" required>
                <option value="">-- Pilih Pesanan --</option>
                @foreach($pesanans as $pesanan)
                    <option value="{{ $pesanan->id }}" {{ old('pesanan_id', $item->pesanan_id) == $pesanan->id ? 'selected' : '' }}>
                        #{{ $pesanan->id }} - {{ $pesanan->pelanggan->nama ?? 'Tanpa Nama' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="produk_id" class="form-label">Produk</label>
            <select name="produk_id" id="produk_id" class="form-control" required>
                <option value="">-- Pilih Produk --</option>
                @foreach($produks as $produk)
                    <option value="{{ $produk->id }}" {{ old('produk_id', $item->produk_id) == $produk->id ? 'selected' : '' }}>
                        {{ $produk->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah', $item->jumlah) }}" min="1" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $item->harga) }}" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>