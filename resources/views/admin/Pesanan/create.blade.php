@extends('layout.app')
@section('content')
<div class="container">
    <h1>Pesanan Baru</h1>
    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary-3">Kembali</a>

    @if (session('error'))
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
                                <button type="button" class="btn btn-success btn-sm tambah-keranjang"
                                    data-id="{{ $produk->id }}"
                                    data-nama="{{ $produk->nama }}"
                                    data-harga="{{ $produk->harga }}"
                                    data-gambar="{{ asset('storage/' . $produk->gambar) }}">
                                    Tambah Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- kolom kanan: produk yang dipilih -->
            <div class="col-md-5">
                <h3>Produk yang dipilih</h3>
                <ul class="list-group mb-3" id="list-pesanan">
                    <li class="list-group-item text-muted text-center" id="empty-message">Belum ada produk yang dipilih</li>
                </ul>
                <div class="form-group">
                    <label for="metode-pembayaran">Metode Pembayaran</label>
                    <select name="metode-pembayaran" class="form-control">
                        <option value="transfer-bank">Transfer Bank</option>
                        <option value="e-wallet">E-Wallet</option>
                        <option value="cod">Cash on Delivery</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <h4>Total: </h4>
                    <h4><strong>Rp.<span id="total-harga">0</span></strong></h4>
                </div>
                <button type="submit" class="btn btn-primary mt-3 w-100">Buat Pesanan</button>
            </div>
        </div>
    </form>
</div>

<style>
    .produk-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

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
    const totalHargaElem = document.getElementById('total-harga');
    let pesananMap = new Map();

    document.querySelectorAll('.tambah-keranjang').forEach(function(button) {
        button.addEventListener('click', function() {
            let produkId = button.dataset.id;
            let produkNama = button.dataset.nama;
            let harga = parseFloat(button.dataset.harga);
            let gambar = button.dataset.gambar;

            if (!pesananMap.has(produkId)) {
                pesananMap.set(produkId, {
                    nama: produkNama,
                    jumlah: 1,
                    harga: harga,
                    subtotal: harga
                });

                if (emptyMessage) {
                    emptyMessage.style.display = 'none';
                }

                let listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';

                listItem.innerHTML = `
                    <div class="d-flex align-items-center">
                        <img src="${gambar}" alt="${produkNama}" class="list-img mr-2">
                        <span class="ml-2">${produkNama}</span>
                    </div>
                    <input type="hidden" name="produkId[]" value="${produkId}">
                    <input type="number" name="jumlah[]" class="form-control form-control-sm jumlah-produk ml-2"
                        data-id="${produkId}"
                        value="1" min="1" style="width: 60px;">
                    <strong>Rp <span class="subtotal">${harga.toLocaleString()}</span></strong>
                    <button type="button" class="btn btn-danger btn-sm hapus-produk" data-id="${produkId}">Hapus</button>
                `;

                listPesanan.appendChild(listItem);
                updateTotal();

                listItem.querySelector('.jumlah-produk').addEventListener('input', updateJumlah);
                listItem.querySelector('.hapus-produk').addEventListener('click', hapusProduk);
            }
        });
    });

    function updateJumlah(event) {
        let input = event.target;
        let produkId = input.dataset.id;
        let jumlah = parseInt(input.value) || 1;
        let produk = pesananMap.get(produkId);
        produk.jumlah = jumlah;
        produk.subtotal = produk.harga * jumlah;
        pesananMap.set(produkId, produk);
        input.closest('li').querySelector('.subtotal').innerText = produk.subtotal.toLocaleString();
        updateTotal();
    }

    function hapusProduk(event) {
        let button = event.target;
        let produkId = button.dataset.id;
        pesananMap.delete(produkId);
        button.closest('li').remove();
        if (pesananMap.size === 0) {
            emptyMessage.style.display = 'block';
        }
        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        pesananMap.forEach((item) => {
            total += item.subtotal;
        });
        totalHargaElem.innerText = total.toLocaleString();
    }
});
</script>
@endsection
