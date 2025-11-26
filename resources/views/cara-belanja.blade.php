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

    <h2 class="mb-4 text-center">Cara Belanja di LapakSiswa</h2>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="step-card">
                <div class="step-number">1</div>
                <h5>Cari Produk</h5>
                <p class="text-muted">
                    Gunakan kolom pencarian atau pilih kategori untuk menemukan produk yang Anda inginkan.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="step-card">
                <div class="step-number">2</div>
                <h5>Kunjungi Toko</h5>
                <p class="text-muted">
                    Klik produk atau nama toko untuk melihat detail lebih lengkap sebelum membeli.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="step-card">
                <div class="step-number">3</div>
                <h5>Pesan via WhatsApp</h5>
                <p class="text-muted">
                    Tekan tombol <strong>Pesan Via WhatsApp</strong> di halaman produk untuk chat langsung dengan penjual.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="step-card">
                <div class="step-number">4</div>
                <h5>Negosiasi & Pembayaran</h5>
                <p class="text-muted">
                    Atur harga, tempat COD, atau metode pembayaran lain sesuai kesepakatan dengan penjual.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="step-card">
                <div class="step-number">5</div>
                <h5>Ambil Produk</h5>
                <p class="text-muted">
                    Ambil pesanan di sekolah sesuai lokasi yang telah disepakati bersama penjual.
                </p>
            </div>
        </div>

    </div>

</div>

@endsection
