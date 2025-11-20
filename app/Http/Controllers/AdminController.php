<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function userindex()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.kelola-user', compact('users'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kontak' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);

        User::create([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return back()->with('success', 'User berhasil ditambahkan!');
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->nama = $request->nama;
        $user->kontak = $request->kontak;
        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'User berhasil diupdate!');
    }

    public function userDelete($id)
    {
        if ($id == Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        User::findOrFail($id)->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }


    public function dashboard()
    {
        $data['total_user'] = User::count();
        $data['total_toko'] = Toko::count();
        $data['pending_toko'] = Toko::where('status', 'pending')->count();
        $data['total_produk'] = Produk::count();

        // Grafik Produk per Kategori
        $kategori = Kategori::withCount('produk')->get();
        $data['kategori_nama'] = $kategori->pluck('nama_kategori');
        $data['kategori_jumlah'] = $kategori->pluck('produk_count');

        // Pending list
        $data['pending_list'] = \App\Models\Toko::where('status', 'pending')->take(5)->get();

        return view('admin.dashboard', $data);
    }


    public function pengajuanToko()
    {
        $toko = Toko::with('user')->orderBy('id', 'DESC')->get();
        return view('admin.pengajuan-toko', compact('toko'));
    }


    public function approveToko($id)
    {
        Toko::where('id', $id)->update(['status' => 'approved']);
        return back()->with('success', 'Toko berhasil disetujui!');
    }

    public function rejectToko($id)
    {
        Toko::where('id', $id)->update(['status' => 'rejected']);
        return back()->with('success', 'Toko ditolak.');
    }


    public function loginpage(){
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'    => 'required|string',
            'password' => 'required'
        ]);

        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return back()->with('error', 'Username atau password salah.');
        }

        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang Admin!');
        }
        if ($user->role === 'member') {
            return redirect()->route('member.dashboard')->with('success', 'Selamat datang Member!');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Anda berhasil logout.');
    }

}
