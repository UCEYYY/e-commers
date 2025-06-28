<?php

namespace App\Http\Controllers;

use App\Models\ItemPesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemPesananController extends Controller
{
    public function index()
    {
        $items = ItemPesanan::all();
        return view('admin.itempesanan.index', compact('items'));
    }

    public function create()
    {
        return view('admin.itempesanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required|exists:pesanans,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ]);

        ItemPesanan::create($request->all());

        return redirect()->route('itempesanan.index')->with('success', 'Item pesanan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $item = ItemPesanan::findOrFail($id);
        return view('admin.itempesanan.show', compact('item'));
    }

    public function edit($id)
    {
        $item = ItemPesanan::findOrFail($id);
        return view('admin.itempesanan.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pesanan_id' => 'required|exists:pesanans,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ]);

        $item = ItemPesanan::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('itempesanan.index')->with('success', 'Item pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = ItemPesanan::findOrFail($id);
        $item->delete();

        return redirect()->route('itempesanan.index')->with('success', 'Item pesanan berhasil dihapus.');
    }
}