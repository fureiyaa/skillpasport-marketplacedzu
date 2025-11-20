@extends('template')

@section('content')

<style>
:root {
        --primary: #202250;
        --secondary: #424769;
        --accent: #7077A1;
        --light: #F5DAD2;
        --dark: #2A2A2A;
        --success: #76817A;
        --edi: #F6B17A
    }

    .toko-header {
        background: var(--primary);
        color: white;
        padding: 35px;
        border-radius: 12px;
    }

    .toko-logo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid white;
    }

    .price-original {
        text-decoration: line-through;
        color: #6c757d;
        font-size: 0.9rem;
    }
    .price-discount {
        color: #dc3545;
        font-weight: bold;
    }
    .badge-category {
        background-color: var(--accent);
        color: white;
    }
    .ikon {
        font-size: 2.5rem;
    }
    .judul-kategori {
        font-weight: 700;
        text-align: center;
    }
    .btn-primary {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    .btn-primary:hover {
        background-color: var(--edi);
        color: var(--primary);
        border-color: var(--edi);
    }
    .btn-outline-primary {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
    }
    .btn-outline-primary:hover {
        background-color: var(--edi);
        color: var(--primary);
        border-color: var(--edi);
    }
    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
</style>

<div class="container mt-4">

    <!-- HEADER TOKO -->
    <div class="toko-header d-flex align-items-center gap-4">
        <img src="{{ asset('asset/image/' . $toko->gambar) }}" class="toko-logo">

        <div>
            <h2 class="mb-1">{{ $toko->nama_toko }}</h2>
            <p class="mb-2">{{ $toko->deskripsi }}</p>

            <a href="https://wa.me/{{ $toko->kontak_toko }}?text=Halo%20saya%20ingin%20bertanya%20tentang%20produk%20di%20toko%20Anda"
               target="_blank"
               class="btn btn-success">
                <i class="fa-brands fa-whatsapp"></i> Hubungi Toko
            </a>
        </div>
    </div>

    <!-- PRODUK -->
    <h3 class="mt-5 mb-3">Produk di Toko Ini</h3>

    <div class="row g-4">
        <div class="all-produk-page container py-5">

            {{-- PRODUK GRID --}}
            <div class="row g-4">
                @forelse ($produk as $item)
                @php
                    $img = $item->gambar->first();
                @endphp
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="card h-100">
                        <a href="{{ route('produk.detail', $item->id) }}">
                            <img src="{{ $img ? asset('asset/image/' . $img->nama_gambar) : asset('asset/image/placeholder.png') }}" class="card-img-top" alt="{{ $item->nama_produk }}"style="height: 300px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <span class="badge badge-category mb-2">{{ $item->kategori->nama_kategori ?? 'Lainnya' }}</span>
                            <h5 class="card-title">{{ $item->nama_produk }}</h5> <div class="d-flex align-items-center">
                                <span class="price-discount me-2"> Rp {{ number_format($item->harga, 0, ',', '.') }} </span>
                                @if ($item->harga_original)
                                <span class="price-original"> Rp {{ number_format($item->harga_original, 0, ',', '.') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 mb-3">
                            <button class="btn btn-primary w-100"><i class="fa-brands fa-whatsapp me-2"></i>Pesan Via WhatsApp</button>
                        </div>
                    </div>
                </div>
                @empty
                    <p class="text-muted">Belum ada produk di toko ini.</p>
                @endforelse

            </div>

        </div>
    </div>

@endsection
