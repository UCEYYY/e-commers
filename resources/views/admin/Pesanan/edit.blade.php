
@extends('layout.app')

@section('content')
<div class="container">
    <h1>Edit Pesanan</h1>
    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="pelanggan_id" class="form-label">Pelanggan</label>
            <select name="pelanggan_id" id="pelanggan_id" class="form-control" required>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}" {{ $pesanan->pelanggan_id == $pelanggan->id ? 'selected' : '' }}>
                        {{ $pelanggan->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Pesanan</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', $pesanan->tanggal) }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="proses" {{ $pesanan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="batal" {{ $pesanan->status == 'batal' ? 'selected' : '' }}>Batal</option>
            </select>
        </div>

        {{-- Tambahkan bagian item pesanan jika diperlukan --}}

        <button type="submit" class="btn btn-primary">Update Pesanan</button>
    </form>