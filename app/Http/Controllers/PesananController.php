<?php

namespace App\Http\Controllers;

use App\Models\ItemPesanan;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use function Laravel\Prompts\progress;

class PesananController extends Controller
{
// ...existing code...
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            // admin melihat semua pesanan
            $pesanan = Pesanan::with(['itemPesanan.produk', 'pelanggan.user'])->get();
        } else {

            // pelanggan hanya melihat pesanan miliknya sendiri
            $pelanggan = Pelanggan::where('user_id', Auth::id())->first();    

            if (!$pelanggan) {
                return redirect()->route('dashboard')->with('error', 'Anda Bukan Pelanggan.');
            }

            $pesanan = Pesanan::where('pelanggan_id', $pelanggan->id)
                ->with(['itemPesanan.produk', 'pelanggan.user'])
                ->get();
        }

        return view('admin.pesanan.index', compact('pesanan'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::where('user_id', Auth::id())->first();

        if (!$pelanggan) {
            return redirect()->route('dashboard')->with('error', 'Anda bukan pelanggan.');
        }

        $produks = Produk::all();
        return view('admin.pesanan.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'array',
            'jumlah' => 'array'
        ]);

        $pelanggan = Pelanggan::where('user_id', Auth::id())->first();

        if (!$pelanggan) {
            return redirect()->route('dashboard')->with('error', 'Anda bukan pelanggan.');
        }
        //validasi/filter hanya produk memiliki jumlah lebih dari 0
        $ProdukDipilih = [];
        foreach ($request->produk_id as $key => $produk_id) {
            if (!empty($request->jumlah[$key]) && $request->jumlah[$key] > 0) {
                $ProdukDipilih[] = [
                    'produk_id' => $produk_id,
                    'jumlah' => $request->jumlah[$key]
                ];
            }
        }

        // cek apakah ada produk yang dipilih atau jumlahnya tidak valid
        if (empty($ProdukDipilih)) {
            return redirect()->back()->with('error', 'Tidak ada produk yang dipilih atau jumlahnya tidak valid.');
        }

        // Buat pesanan baru
        $total = 0;
        $pesanan = Pesanan::create([
            'pelanggan_id' => $pelanggan->id,
            'status' => 'baru',
            'metode_pembayaran' => $request->metode_pembayaran,
            'total' => 0,
        ]);
        // Simpan item pesanan
        foreach ($ProdukDipilih as $item) {
            $produk = Produk::find($item['produk_id']);

            if ($produk) {
                $subtotal = $produk->harga * $item['jumlah'];
                ItemPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $produk->id,
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $subtotal,
                ]);
                $total += $subtotal;
            }
        }

        // Update total pesanan
        $pesanan->update(['total' => $total]);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function show(Pesanan $pesanan)
    {
        $pesanan->load('itemPesanan.produk');

        if (Auth::user()->hasRole('pelanggan')) {
            $pelanggan = Pelanggan::where('user_id', Auth::id())->first();
            if (!$pelanggan || $pesanan->pelanggan_id !== $pelanggan->id) {
                return redirect()->route('pesanan.index')->with('error', 'Anda tidak memiliki akses ke pesanan ini.');
            }
        }
        return view('admin.pesanan.show', compact('pesanan'));
    }

    public function destroy(Pesanan $pesanan)
    {
        if (Auth::user()->hasRole('pelanggan')) {
            $pelanggan = Pelanggan::where('user_id', Auth::id())->first();
            if (!$pelanggan || $pesanan->pelanggan_id !== $pelanggan->id) {
                return redirect()->route('pesanan.index')->with('error', 'Anda tidak memiliki akses untuk menghapus pesanan ini.');
            }
        }

        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus!');
    }
}