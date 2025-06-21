<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = ['pelanggan_id', 'status', 'metode_pembayaran'];

    public function itempesanan()
    {
        return $this->hasMany(ItemPesanan::class, 'pesanan_id');
    }

    // Relasi dengan Pelanggan (one to many)
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    
    }

    
}
