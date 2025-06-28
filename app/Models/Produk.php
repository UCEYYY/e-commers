<?php

namespace App\Models;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'kategori_id',
        'nama',
        'deskripsi',
        'gambar',
        'harga',
        'stok'
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
