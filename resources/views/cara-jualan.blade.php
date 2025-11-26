@extends('template')
@section('content')

<style>
    .step-card {
        border: none;
        padding: 25px;
        border-radius: 18px;
        background: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: .2s;
    }
    .step-card:hover {
        transform: translateY(-5px);
    }
    .step-number {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        margin-bottom: 15px;
        font-size: 18px;
    }
    h2 {
        font-weight: 700;
        color: var(--primary);
    }
</style>

<div class="container py-5">

    <h2 class="mb-4 text-center">Cara Jualan di LapakSiswa</h2>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="step-card">
                <div class="step-number">1</div>
                <h5>Daftar / Login</h5>
                <p class="text-muted">
                    Buat akun sebagai member atau login jika sudah memiliki akun.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="step-card">
                <div class="step-number">2</div>
                <h5>Ajukan Toko</h5>
                <p class="text-muted">
                    Masuk ke menu <strong>Kelola Toko</strong> dan ajukan pembuatan toko baru.
                    Admin akan meninjau pengajuan Anda.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="step-card">
                <div class="step-number">3</div>
                <h5>Tunggu Persetujuan</h5>
                <p class="text-muted">
                    Setelah disetujui, toko Anda akan aktif dan muncul di halaman beranda.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="step-card">
                <div class="step-number">4</div>
                <h5>Tambah Produk</h5>
                <p class="text-muted">
                    Masuk ke menu <strong>Produk Anda</strong> lalu tambahkan gambar, harga, dan deskripsi produk.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="step-card">
                <div class="step-number">5</div>
                <h5>Mulai Berjualan</h5>
                <p class="text-muted">
                    Produk Anda akan tampil di marketplace dan bisa dibeli oleh siswa lainnya.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="step-card">
                <div class="step-number">6</div>
                <h5>Chat Pembeli</h5>
                <p class="text-muted">
                    Pembeli akan menghubungi Anda melalui tombol WhatsApp di halaman produk.
                </p>
            </div>
        </div>

    </div>

</div>

@endsection