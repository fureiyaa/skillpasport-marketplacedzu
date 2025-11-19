<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GambarProduk;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function registerPage()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:5'
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'member'
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login.');
    }

    public function updateProduk(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori_id' => 'required',
            'gambar.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $produk = Produk::findOrFail($id);

        // update field
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
        ]);

        // jika upload gambar baru
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama
            foreach ($produk->gambar as $g) {
                $path = public_path('asset/image/' . $g->nama_gambar);
                if (file_exists($path)) unlink($path);
                $g->delete();
            }

            // upload gambar baru
            foreach ($request->file('gambar') as $file) {
                $nama = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('asset/image'), $nama);

                GambarProduk::create([
                    'produk_id' => $produk->id,
                    'nama_gambar' => $nama
                ]);
            }
        }

        return back()->with('success', 'Produk berhasil diperbarui!');
    }

    public function produkStore(Request $request)
    {
        $request->validate([
            'nama_produk'   => 'required',
            'harga'         => 'required|numeric',
            'stok'          => 'required|integer|min:0',
            'deskripsi'     => 'required',
            'kategori_id'   => 'required',
            'gambar.*'      => 'image|max:4096'
        ]);

        $toko = Auth::user()->toko;

        $produk = Produk::create([
            'nama_produk'    => $request->nama_produk,
            'harga'          => $request->harga,
            'stok'           => $request->stok,        // ✔ stok ikut create
            'deskripsi'      => $request->deskripsi,
            'kategori_id'    => $request->kategori_id,
            'toko_id'        => $toko->id,
            'tanggal_upload' => now()
        ]);

        if ($request->hasFile('gambar')) {
            foreach ($request->gambar as $file) {
                $nama = time().rand().'.'.$file->extension();
                $file->move(public_path('asset/image'), $nama);

                GambarProduk::create([
                    'produk_id'   => $produk->id,
                    'nama_gambar' => $nama
                ]);
            }
        }

        return redirect()->route('member.kelola')
            ->with('success', 'Produk berhasil ditambahkan!');
    }


    public function updateToko(Request $request)
    {
        $user = Auth::user();
        $toko = $user->toko;

        if (!$toko) return back()->with('error', 'Toko belum dibuat!');

        $toko->nama_toko = $request->nama_toko;
        $toko->deskripsi = $request->deskripsi;
        $toko->kontak_toko = $request->kontak_toko;

        if ($request->hasFile('gambar')) {
            $foto = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('asset/image'), $foto);
            $toko->gambar = $foto;
        }

        $toko->save();

        return back()->with('success', 'Toko berhasil diperbarui!');
    }

    public function dashboard()
    {
        $user = Auth::user();

        return view('member.dashboard', [
            'toko' => $user->toko
        ]);
    }

    public function kelola()
    {
        $user = Auth::user();

        return view('member.kelola', [
            'toko'   => $user->toko,               // toko yang dimiliki member
            'produk' => $user->toko->produk ?? [] // semua produk toko tsb
        ]);
    }

    public function search(Request $request)
    {
        // ambil dari ?search= atau ?q= (dua-duanya diterima)
        $keyword = $request->search ?? $request->q ?? '';

        if (!$keyword) {
            return view('search-result', [
                'keyword' => '',
                'produk' => collect(),
                'toko' => collect(),
            ]);
        }

        // Cari produk
        $produk = Produk::with('gambar', 'kategori')
            ->where('nama_produk', 'like', "%$keyword%")
            ->orWhere('deskripsi', 'like', "%$keyword%")
            ->get();

        // Cari toko
        $toko = Toko::where('nama_toko', 'like', "%$keyword%")
            ->orWhere('deskripsi', 'like', "%$keyword%")
            ->get();

        return view('search', compact('keyword', 'produk', 'toko'));
    }



    public function home()
    {
        $data['kategori'] = Kategori::all();
        $data['produk'] = Produk::with(['kategori', 'toko','gambar'])->orderBy('id', 'DESC')->take(8)->get();
        $data['toko'] = Toko::with('user')->orderBy('id', 'DESC')->take(4)->get();
        $data['gambar'] = GambarProduk::all();

        return view('beranda', $data);
    }
}
