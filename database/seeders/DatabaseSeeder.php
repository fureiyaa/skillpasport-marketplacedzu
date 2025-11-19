<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Toko;
use App\Models\Produk;
use App\Models\GambarProduk;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /* ======================================================
            USER DUMMY
        ======================================================= */
        $user1 = User::create([
            'nama' => 'Admin Marketplace',
            'kontak' => '08123456789',
            'username' => 'admin1',
            'password' => bcrypt('password123'),
            'role' => 'admin'
        ]);

        $user2 = User::create([
            'nama' => 'Siswa Penjual',
            'kontak' => '08987654321',
            'username' => 'siswa_jual',
            'password' => bcrypt('password123'),
            'role' => 'member'
        ]);

        $user3 = User::create([
            'nama' => 'Siswa Kuliner',
            'kontak' => '082233445566',
            'username' => 'siswa_makanan',
            'password' => bcrypt('password123'),
            'role' => 'member'
        ]);


        /* ======================================================
            KATEGORI
        ======================================================= */
        $kategori1 = Kategori::create(['nama_kategori' => 'Buku & Alat Tulis']);
        $kategori2 = Kategori::create(['nama_kategori' => 'Jasa & Bantuan']);
        $kategori3 = Kategori::create(['nama_kategori' => 'Makanan & Minuman']);
        $kategori4 = Kategori::create(['nama_kategori' => 'Fashion']);


        /* ======================================================
            TOKO
        ======================================================= */
        $toko1 = Toko::create([
            'user_id' => $user1->id,
            'nama_toko' => 'Toko Buku Pintar',
            'deskripsi' => 'Menjual berbagai perlengkapan sekolah lengkap.',
            'kontak_toko' => '0811111111',
            'alamat' => 'Sekitar Sekolah',
            'gambar' => 'toko.jpeg'
        ]);

        $toko2 = Toko::create([
            'user_id' => $user2->id,
            'nama_toko' => 'Jasa Siswa Kreatif',
            'deskripsi' => 'Menyediakan berbagai jasa dari siswa.',
            'kontak_toko' => '0822222222',
            'alamat' => 'Area Kantin',
            'gambar' => 'toko.jpeg'
        ]);

        $toko3 = Toko::create([
            'user_id' => $user3->id,
            'nama_toko' => 'Makanan Lezat',
            'deskripsi' => 'Aneka makanan dan minuman buatan siswa.',
            'kontak_toko' => '0833333333',
            'alamat' => 'Depan Lapangan',
            'gambar' => 'toko.jpeg'
        ]);


        $produk1 = Produk::create([
            'kategori_id' => $kategori1->id,
            'toko_id' => $toko1->id,
            'nama_produk' => 'Paket Alat Tulis Lengkap',
            'harga' => 25000,
            'stok' => 40,
            'deskripsi' => 'Buku + Pulpen + Pensil + Penghapus',
        ]);

        $produk2 = Produk::create([
            'kategori_id' => $kategori2->id,
            'toko_id' => $toko2->id,
            'nama_produk' => 'Jasa Desain Logo',
            'harga' => 15000,
            'stok' => 10,
            'deskripsi' => 'Jasa desain logo untuk tugas atau organisasi.',
        ]);

        $produk3 = Produk::create([
            'kategori_id' => $kategori3->id,
            'toko_id' => $toko3->id,
            'nama_produk' => 'Nasi Ayam Geprek Level 10',
            'harga' => 12000,
            'stok' => 20,
            'deskripsi' => 'Ayam geprek pedas gurih buatan siswa.',
        ]);

        $produk4 = Produk::create([
            'kategori_id' => $kategori4->id,
            'toko_id' => $toko3->id,
            'nama_produk' => 'Kaos Siswa Keren',
            'harga' => 45000,
            'stok' => 25,
            'deskripsi' => 'Kaos desain trendy untuk pelajar.',
        ]);

        $produk5 = Produk::create([
            'kategori_id' => $kategori1->id,
            'toko_id' => $toko1->id,
            'nama_produk' => 'Paket Alat Tulis Lengkap',
            'harga' => 25000,
            'stok' => 40,
            'deskripsi' => 'Buku + Pulpen + Pensil + Penghapus',
        ]);

        $produk6 = Produk::create([
            'kategori_id' => $kategori2->id,
            'toko_id' => $toko2->id,
            'nama_produk' => 'Jasa Desain Logo',
            'harga' => 15000,
            'stok' => 10,
            'deskripsi' => 'Jasa desain logo untuk tugas atau organisasi.',
        ]);

        $produk7 = Produk::create([
            'kategori_id' => $kategori3->id,
            'toko_id' => $toko3->id,
            'nama_produk' => 'Nasi Ayam Geprek Level 10',
            'harga' => 12000,
            'stok' => 20,
            'deskripsi' => 'Ayam geprek pedas gurih buatan siswa.',
        ]);

        $produk8 = Produk::create([
            'kategori_id' => $kategori4->id,
            'toko_id' => $toko3->id,
            'nama_produk' => 'Kaos Siswa Keren',
            'harga' => 45000,
            'stok' => 25,
            'deskripsi' => 'Kaos desain trendy untuk pelajar.',
        ]);

        GambarProduk::create([
            'produk_id' => $produk1->id,
            'nama_gambar' => 'tulis.jpeg'
        ]);

        GambarProduk::create([
            'produk_id' => $produk2->id,
            'nama_gambar' => 'produkjasa.jpeg'
        ]);

        GambarProduk::create([
            'produk_id' => $produk3->id,
            'nama_gambar' => 'ayam.jpeg'
        ]);

        GambarProduk::create([
            'produk_id' => $produk4->id,
            'nama_gambar' => 'produk.jpeg'
        ]);

        GambarProduk::create([
            'produk_id' => $produk5->id,
            'nama_gambar' => 'tulis.jpeg'
        ]);

        GambarProduk::create([
            'produk_id' => $produk6->id,
            'nama_gambar' => 'produkjasa.jpeg'
        ]);

        GambarProduk::create([
            'produk_id' => $produk7->id,
            'nama_gambar' => 'ayam.jpeg'
        ]);

        GambarProduk::create([
            'produk_id' => $produk8->id,
            'nama_gambar' => 'produk.jpeg'
        ]);
    }
}
