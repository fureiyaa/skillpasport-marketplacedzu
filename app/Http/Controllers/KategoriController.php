<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function kategori($id)
    {
        $kategori = Kategori::findOrFail($id);

        // Ambil produk berdasarkan kategori
        $data['produk'] = Produk::with('gambar')
            ->where('kategori_id', $id)
            ->orderBy('id', 'DESC')
            ->get();

        // Ambil juga kategori (untuk menu tetap tampil)
        $data['kategori'] = Kategori::all();

        // Ambil toko jika dipakai
        $data['toko'] = Toko::all();

        // Kirim kategori yang sedang dipilih
        $data['selectedKategori'] = $kategori;

        return view('kategori', $data);
    }

}
