<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama'];

    // //relasi dengan Produk (one to many)
    public function produks()
    {
     return $this->hasMany(Produk::class);
    }

   
}
