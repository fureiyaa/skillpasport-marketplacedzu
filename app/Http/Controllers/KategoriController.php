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
   public function index()
    {
        $data['kategori'] = Kategori::all();
        return view('admin.kategori', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'icon' => 'required',
            'background' => 'image|max:4096'
        ]);

        $fileName = null;

        if ($request->hasFile('background')) {
            $file = $request->background;
            $fileName = time().rand().'.'.$file->extension();
            $file->move(public_path('asset/kategori'), $fileName);
        }

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'icon' => $request->icon,
            'background' => $fileName
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $data = $request->validate([
            'nama_kategori' => 'required',
            'icon' => 'required',
            'background' => 'image|max:4096'
        ]);

        if ($request->hasFile('background')) {
            $file = $request->background;
            $namaBaru = time().rand().'.'.$file->extension();
            $file->move(public_path('asset/kategori'), $namaBaru);

            $data['background'] = $namaBaru;
        }

        $kategori->update($data);

        return back()->with('success', 'Kategori diperbarui!');
    }

    public function delete($id)
    {
        Kategori::where('id', $id)->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }

}
