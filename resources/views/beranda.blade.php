@extends('template')

@section('content')
<div class="homepage">

<style>
/* ============================================================
   SCOPED CSS — HANYA BISA MENGUBAH ELEMEN DI DALAM .homepage
   ============================================================ */
.homepage {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* ---------------- BANNER ---------------- */
.homepage-banner-wrapper {
    width: 100%;
    height: 600px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f8f9fa;
}

.homepage-banner-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: .6s ease;
}

.homepage-banner-img:hover {
    transform: scale(1.02);
    opacity: 0.95;
}

        :root {
            --primary: #202250;
            --secondary: #424769;
            --accent: #7077A1;
            --light: #F5DAD2;
            --dark: #2A2A2A;
            --success: #76817A;
            --edi: #F6B17A;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: white;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* === CATEGORY CARD WITH COLORED OVERLAY === */
        .category-wrapper {
            position: relative;
            z-index: 10; /* TARUH DI DEPAN BANNER */
            margin-top: -200px;
            background-color: rgba(255, 255, 255, 0.95); /* lebih elegan */
            backdrop-filter: blur(6px); /* estetis premium */
            padding: 30px;
            border-radius: 15px;
        }
        .category-card {
            height: 150px;
            border-radius: 14px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .4s ease;
        }

        /* Overlay gradasi transparan – NUANSA ORANGE & NAVY */
        .category-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background-color: rgba(32, 34, 80, 0.685) ;
        }

        .category-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        /* Ikon dan teks di atas overlay */
        .category-card .text-center {
            position: relative;
            z-index: 2;
            color: white;
            font-weight: 600;
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

</style>
    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <div class="homepage-banner-wrapper">
                    <img src="{{ asset('asset/image/makan.jpg') }}" class="homepage-banner-img">
                </div>
            </div>

            <div class="carousel-item">
                <div class="homepage-banner-wrapper">
                    <img src="{{ asset('asset/image/baju.jpg') }}" class="homepage-banner-img">
                </div>
            </div>
            <div class="carousel-item">
                <div class="homepage-banner-wrapper">
                    <img src="{{ asset('asset/image/alat2.jpg') }}" class="homepage-banner-img">
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>


    <!-- Kategori -->
    <section class="py-5">
        <div class="container category-wrapper shadow-sm">
            <h2 class="judul-kategori mb-4">Kategori Produk</h2>
            <div class="row g-3">
                @foreach ($kategori as $k)
                <div class="col-md-3 col-6">
                    <a href="{{ route('kategori.pilih', $k->id) }}">
                        <div class="category-card"
                            style="background-image: url('{{ asset('asset/kategori/'.$k->background) }}')">

                            <div class="text-center">
                                <i class="{{ $k->icon }} ikon"></i>
                                <p class="mt-2">{{ $k->nama_kategori }}</p>
                            </div>

                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
<section class="py-5 bg-light">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Produk Terbaru</h2>
            <a href="{{ route('produk.all') }}" class="btn btn-outline-primary">Lihat Semua</a>
        </div>

        <div class="row">

            <!-- Banner kiri -->
            <div class="col-lg-4">
                <img src="{{ asset('asset/image/promo2.png') }}"
                     class="img-fluid rounded shadow-sm"
                     style="height: 750px; object-fit: cover;">
            </div>

            <!-- Produk kanan -->
            <div class="col-lg-8">
                <div class="row g-4">
                    @foreach ($produk->take(8) as $item)
                    @php
                        $img = $item->gambar->first();
                    @endphp
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="card h-100">
                            <a href="{{ route('produk.detail', $item->id) }}">
                                <img src="{{ $img ? asset('asset/image/' . $img->nama_gambar) : asset('asset/image/placeholder.png') }}"
                                    class="card-img-top"
                                    alt="{{ $item->nama_produk }}"
                                    style="height: 160px; object-fit: cover;">
                            </a>
                            <div class="card-body">
                                <span class="badge badge-category mb-2">
                                    {{ $item->kategori->nama_kategori ?? 'Lainnya' }}
                                </span>
                                <h6 class="card-title">
                                    {{ Str::limit($item->nama_produk, 40) }}
                                </h6>
                                <div class="d-flex align-items-center">
                                    <span class="price-discount me-2">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </span>

                                    @if ($item->harga_original)
                                    <span class="price-original">
                                        Rp {{ number_format($item->harga_original, 0, ',', '.') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <button class="btn btn-primary w-100">
                                    Pesan Via WhatsApp
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Toko Terpopuler -->
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Toko Terpopuler</h2>
            <a href="{{ route('toko.all') }}" class="btn btn-outline-primary">Lihat Semua</a>
        </div>
        <div class="row g-4">
            <!-- Toko 1 -->
            @foreach ($toko as $item)
            <div class="col-lg-3 col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="{{ asset('asset/image/' . $item->gambar) }}"
                            class="rounded-circle mb-3"
                            alt="Toko"
                            style="width: 80px; height: 80px; object-fit: cover;">

                        <h5 class="card-title">{{ $item->nama_toko }}</h5>

                        <p class="card-text text-muted" style="min-height: 60px;">
                            {{ Str::limit($item->deskripsi, 70) }}
                        </p>

                        <div class="d-flex justify-content-center">
                            <span class="badge bg-light text-dark me-2">
                                <i class="bi bi-star-fill text-warning"></i> 4.8
                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="bi bi-bag-check"></i> {{ rand(80, 500) }} produk
                            </span>
                        </div>
                        <a href="{{ route('toko.detail', $item->id) }}" class="btn btn-outline-primary mt-3">Kunjungi Toko</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


</div> {{-- END homepage --}}
@endsection
