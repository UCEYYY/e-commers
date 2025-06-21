<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Pelanggan extends Model
{
    protected $fillable = ['user_id', 'telepon', 'alamat'];

    // Relasi dengan User (one to one)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relasi dengan Pesanan (one to many)
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
}
}  // End of Class
