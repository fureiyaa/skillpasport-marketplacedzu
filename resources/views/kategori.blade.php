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
<div class="container py-5 kategori-page">

    {{-- ======= TITLE ======= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: var(--primary);">
            Kategori: {{ $selectedKategori->nama_kategori }}
        </h2>

        <a href="/" class="btn btn-outline-primary">
            Kembali
        </a>
    </div>

    {{-- ======= PRODUK ======= --}}
    <div class="row g-4">

        @foreach ($produk as $item)
        @php
            $img = $item->gambar->first();
        @endphp
        <div class="col-lg-3 col-md-4 col-6">
            <div class="card h-100">
                <img src="{{ $img ? asset('asset/image/' . $img->nama_gambar) : asset('asset/image/placeholder.png') }}" class="card-img-top" alt="{{ $item->nama_produk }}"style="height: 300px; object-fit: cover;">
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
        @endforeach
    </div>
</div>

{{-- ====== CSS CUSTOM KHUSUS PAGE INI ====== --}}
<style>
    .produk-card {
        border: none;
        border-radius: 12px;
        transition: 0.3s;
    }

    .produk-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .price-original {
        text-decoration: line-through;
        color: #6c757d;
        font-size: 0.85rem;
    }

    .kategori-page h2 {
        font-size: 1.8rem;
    }
</style>

@endsection
