<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
            'kontak_toko' => $request->kontak_toko,
            'gambar' => $nama_gambar,
            'status' => 'pending', // otomatis pending
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Pengajuan toko berhasil dikirim!');
    }


}
