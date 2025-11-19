<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $guarded = [];
    public function toko(){
        return $this->belongsTo(Toko::class);
    }
    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
    public function gambar(){
        return $this->hasMany(GambarProduk::class);
    }


}
