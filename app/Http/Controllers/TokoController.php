<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokoController extends Controller
{
    public function toko(Request $request)
    {
        $query = Toko::query();

        if ($request->search) {
            $query->where('nama_toko', 'like', '%' . $request->search . '%');
        }

        $data['toko'] = $query->orderBy('id', 'DESC')->paginate(16);

        return view('toko', $data);
    }
    public function formToko()
    {
        return view('public.buat-toko');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'kontak_toko' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        // Upload gambar
        $file = $request->file('gambar');
        $nama_gambar = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('asset/image'), $nama_gambar);

        // SIMPAN DATA
        Toko::create([
            'nama_toko' => $request->nama_toko,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'kontak_toko' => $request->kontak_toko,
            'gambar' => $nama_gambar,
            'status' => 'pending', // otomatis pending
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Pengajuan toko berhasil dikirim!');
    }
    public function detail($id)
    {
        $data['toko'] = Toko::with('user')->findOrFail($id);
        $data['produk'] = Produk::where('toko_id', $id)
                                ->with('gambar', 'kategori')
                                ->get();

        return view('detail-toko', $data);
    }
    public function delete(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required'
        ]);

        $toko = Toko::with('produk.gambar')->findOrFail($id);
        $user = $toko->user;

        // ======================
        // Hapus produk + gambar
        // ======================
        foreach ($toko->produk as $produk) {
            foreach ($produk->gambar as $g) {
                $path = public_path('asset/image/' . $g->nama_gambar);
                if (file_exists($path)) unlink($path);
            }
            $produk->gambar()->delete();
            $produk->delete();
        }

        if ($toko->gambar) {
            $pathToko = public_path('asset/image/' . $toko->gambar);
            if (file_exists($pathToko)) unlink($pathToko);
        }

        $toko->delete();
        Notifikasi::create([
            'user_id' => $user->id,
            'pesan' => "Toko Anda telah dihapus oleh admin. Alasan: " . $request->alasan . "silahkan ajukan ulang apabila ingin membuat toko kembali",
        ]);

        return back()->with('success', 'Toko berhasil dihapus & notifikasi dikirim.');
    }

}
