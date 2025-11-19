<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function pengajuanToko()
    {
        $pending = Toko::where('status', 'pending')->get();
        return view('admin.pengajuan-toko', compact('pending'));
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
