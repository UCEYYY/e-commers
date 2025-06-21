<?php

namespace App\Http\Controllers;
use App\Models\Kategori;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan daftar kategori
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }
    public function create()
    {
        // Logika untuk menampilkan form tambah kategori
        return view('admin.kategori.create');
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|unique:kategoris',
        ]);

        // Simpan kategori baru
        Kategori::create($request->all());

        // Redirect ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
    public function edit(Kategori $kategori)
    {
        // Logika untuk menampilkan form edit kategori
        return view('admin.kategori.edit', compact('kategori'));
    }
    public function update(Request $request, Kategori $kategori)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|unique:kategoris,nama,' . $kategori->id,
        ]);

        // Update kategori
        $kategori->update($request->all());

        // Redirect ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }
    public function destroy(Kategori $kategori)
    {
        // Hapus kategori
        $kategori->delete();

        // Redirect ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
