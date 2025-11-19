<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
use App\Models\Produk;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/search', [UserController::class, 'search'])->name('search');
Route::get('/kategori/{id}', [KategoriController::class, 'kategori'])->name('kategori.pilih');
Route::get('/produk', [ProdukController::class, 'produk'])->name('produk.all');
Route::get('/toko', [TokoController::class, 'toko'])->name('toko.all');
Route::get('/buat-toko', [TokoController::class, 'formToko'])->name('toko.form');
Route::get('/detail/produk/{id}', [ProdukController::class, 'detail'])->name('produk.detail');



Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/pengajuan-toko', [AdminController::class, 'pengajuanToko'])->name('admin.pengajuan-toko');
    Route::post('/admin/toko/approve/{id}', [AdminController::class, 'approveToko'])->name('admin.toko.approve');
    Route::post('/admin/toko/reject/{id}', [AdminController::class, 'rejectToko'])->name('admin.toko.reject');
    Route::get('/admin/produk', [ProdukController::class, 'adminProduk'])->name('admin.produk');
    Route::post('/admin/produk/delete/{id}', [ProdukController::class, 'adminProdukDelete'])->name('admin.produk.delete');
});

Route::middleware(['member'])->group(function () {
    Route::get('/member/dashboard', [UserController::class, 'dashboard'])->name('member.dashboard');

    Route::get('/member/kelola', [UserController::class, 'kelola'])->name('member.kelola');
    Route::post('/buat-toko', [TokoController::class, 'store'])->name('toko.store');
    Route::post('/member/toko/update', [UserController::class, 'updateToko'])->name('toko.update');

    Route::post('/member/produk/store', [UserController::class, 'produkStore'])->name('produk.store');

    Route::post('/member/produk/update/{id}', [UserController::class, 'updateProduk'])->name('produk.update');

    Route::post('/member/produk/delete/{id}', [UserController::class, 'produkDelete'])->name('produk.delete');
});

Route::get('/register', [UserController::class, 'registerPage'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.process');
Route::get('/login', [AdminController::class, 'loginpage'])->name('login');
Route::post('/login', [AdminController::class, 'login'])->name('login.process');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');



