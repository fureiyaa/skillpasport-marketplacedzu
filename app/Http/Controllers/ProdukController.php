<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function produk(Request $request)
    {
        $query = Produk::with(['kategori', 'gambar']);

        if ($request->search) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        $data['produk'] = $query->orderBy('id', 'DESC')->paginate(16);

        return view('produk', $data);
    }
    public function detail($id)
    {
        $data['toko'] = Toko::with('user')->orderBy('id', 'DESC')->get();
        $data['produk'] = Produk::with(['gambar', 'kategori', 'toko'])
                                ->findOrFail($id);
        $data['produk_lain'] = Produk::where('toko_id', $data['produk']->toko_id)
                                    ->where('id', '!=', $id)
                                    ->take(4)
                                    ->get();
        return view('detail-produk', $data);
    }
    public function adminProduk()
    {
        $data['produk'] = Produk::with(['kategori', 'toko', 'gambar'])
                                ->orderBy('id', 'DESC')
                                ->get();

        return view('admin.produk', $data);
    }

    public function adminProdukDelete($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar fisik
        foreach ($produk->gambar as $g) {
            $path = public_path('asset/image/' . $g->nama_gambar);
            if (file_exists($path)) unlink($path);
        }

        $produk->gambar()->delete();
        $produk->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}
