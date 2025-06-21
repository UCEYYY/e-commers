@extends('layout.app')
@section('content')
<div class="container">
    <h1>Pesanan Baru</h1>
    <a href="{{ route ('pesanan.index')}}" class="btn btn-secondary-3">Kembali</a>
    if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('pesanan.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- kolom Kirim produk -->
            <div class="col-md-7">
                <h3>Pilih Produk</h3>
                <div class="row">
                    @foreach ($produks as $produk)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <img src="{{ asset('storage/' . $produk->gambar) }}" class="card-img-top" alt="{{ $produk->nama }}">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $produk->nama }}</h5>
                                <p class="card-text text-muted">Rp {{ number_format($produk->harga, 2) }}</p>
                                <button type="button" class="btn btn-success btn-sm tambah-keranjang" data-id="{{ $produk->id }}" data-nama="{{ $produk->nama }}" data-harga="{{ $produk->harga }}">Tambah Keranjang</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- kolom kanan: produk yang dipilih -->
             <div class="col-md-5"></div>
             <h3>Produk yang dipilih</h3>
             <ul class="list-group mb-3" id="list-pesanan">
                <li class="list-group-item text-muted text-center" id="empty-message">Belum ada produk yang dipilih</li>
             </ul>
             <div class="form-group">
                <label for="metode-pembayaran">Metode Pembayaran</label>
                <select name="metode-pembayaran" class="form-control">
                    <option value="transfer-bank">Transfer Bank</option>
                    <option value="e-wallet">E-Eallet</option>
                    <option value="cod">Cash on Delivery</option>
                </select>
             </div>
             <div class="d-flex justify-content-between align-items-center mt-3">
                <h4>Total: </h4>
                <h4><strong>Rp.<span id="total-harga">0</span></strong></h4>
             </div>
             <button type="submit" class="btn btn-primary mt-3 w-100">Buat Pesanan</button>
        </div>
    </form>
</div>
<style>
    /* CSSuntuk memastikan ukuran gambar seragam */
    .produk-img{
        width: 100%;
        height: 200%;
        object-fit: cover;
    }
    /* ukuran gambar didaftar pesanan */
    .list-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const listPesanan = document.getElementById('list-pesanan');
        const emptyMessage = document.getElementById('empty-message');
        const totalHarga = document.getElementById('total-harga');
        let total = 0;
        let pesananMap = new Map();

        document.querySelectorAll('.tambah-keranjang').forEach(function(btn) {
            button.addEventListener('click', function() {
                let produkId = btn.dataset.id;
                let produkNama = btn.dataset.nama;
                let harga = parseFloat(btn.dataset.harga);
                let gambar = btn.dataset.gambar;

                if (pesananMap.has(produkId)) {
                    pesananMap.get(produkId, {nama:produkNama, jumlah: 1, harga:harga, subtotal:harga});
                   
                }

                pesananMap.set(id, { nama, harga });
                total += harga;

                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                listItem.innerHTML = `<img src="/storage/${id}.jpg" class="list-img" alt="${nama}"> ${nama} <span class="badge bg-primary rounded-pill">Rp ${harga.toFixed(2)}</span>`;
                
                listPesanan.appendChild(listItem);
                emptyMessage.style.display = 'none';
                totalHarga.textContent = total.toFixed(2);
            });

        
        });
    