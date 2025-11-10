@extends('template')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduMart - Marketplace Sekolah</title>

    {{-- Bootstrap & FontAwesome --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        /* === BANNER === */
        .carousel-item img {
            transition: transform 0.6s ease-in-out, opacity 0.6s ease-in-out;
        }
        .carousel-item img:hover {
            transform: scale(1.02);
            opacity: 0.95;
        }
        .banner-wrapper {
            width: 100%;
            height: 500px; /* kamu bisa ubah misal 400-500px sesuai kebutuhan */
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa; /* fallback background */
            }

        .banner-img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* menjaga rasio dan crop otomatis */
            object-position: center; /* pastikan gambar di-center */
            transition: transform 0.6s ease, opacity 0.6s ease;
            }

        .banner-img:hover {
            transform: scale(1.02);
            opacity: 0.95;
            }

        /* === CARD KATEGORI === */
        .category-card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.15);
        }
        .category-card i {
            transition: transform 0.3s ease, color 0.3s ease;
        }
        .category-card:hover i {
            transform: scale(1.15);
            color: #F6B17A;
        }
        .category-card h5 {
            color: #2D3250;
            transition: color 0.3s ease;
        }
        .category-card:hover h5 {
            color: #424769;
        }

        /* === PROMO SECTION === */
        .promo-section {
            background-color: #2D3250;
            color: white;
            transition: background 0.4s ease;
        }
        .promo-section:hover {
            background-color: #424769;
        }
        .promo-section .highlight {
            color: #F6B17A;
        }

        /* === TOMBOL INTERAKTIF === */
        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(255,255,255,0.4);
        }

        /* === FOOTER === */
        .footer-custom {
            background-color: #424769;
            color: white;
            font-size: 0.9rem;
        }
        .footer-custom small {
            opacity: 0.8;
            transition: opacity 0.3s;
        }
        .footer-custom:hover small {
            opacity: 1;
        }
    </style>
</head>
<body class="min-vh-100">
    <!-- Banner Carousel -->
    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <div class="banner-wrapper">
            <img src="{{ asset('asset/image/banner1.png') }}" class="banner-img" alt="Banner 1">
        </div>
        </div>
        <div class="carousel-item">
        <div class="banner-wrapper">
            <img src="{{ asset('asset/image/banner2.png') }}" class="banner-img" alt="Banner 2">
        </div>
        </div>
        <div class="carousel-item">
        <div class="banner-wrapper">
            <img src="{{ asset('asset/image/banner3.png') }}" class="banner-img" alt="Banner 3">
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


    <!-- Kategori Produk -->
    <section class="py-5 bg-light">
      <div class="container">
        <h2 class="text-center mb-5 fw-semibold text-dark animate__animated animate__fadeInDown">Kategori Produk Sekolah</h2>
        <div class="row text-center">
          <div class="col-md-3 mb-4 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="card category-card p-4">
              <i class="fa-solid fa-book fa-3x text-primary mb-3"></i>
              <h5>Alat Tulis</h5>
              <p class="small text-muted">Lengkapi kebutuhan menulis dan belajar siswa.</p>
              <a href="#" class="btn btn-primary btn-sm">Lihat Produk</a>
            </div>
          </div>
          <div class="col-md-3 mb-4 animate__animated animate__fadeInUp animate__delay-2s">
            <div class="card category-card p-4">
              <i class="fa-solid fa-shirt fa-3x text-primary mb-3"></i>
              <h5>Seragam Sekolah</h5>
              <p class="small text-muted">Berbagai seragam dan atribut sekolah tersedia.</p>
              <a href="#" class="btn btn-primary btn-sm">Lihat Produk</a>
            </div>
          </div>
          <div class="col-md-3 mb-4 animate__animated animate__fadeInUp animate__delay-3s">
            <div class="card category-card p-4">
              <i class="fa-solid fa-laptop fa-3x text-primary mb-3"></i>
              <h5>Elektronik Edukasi</h5>
              <p class="small text-muted">Laptop, proyektor, dan perangkat belajar digital.</p>
              <a href="#" class="btn btn-primary btn-sm">Lihat Produk</a>
            </div>
          </div>
          <div class="col-md-3 mb-4 animate__animated animate__fadeInUp animate__delay-4s">
            <div class="card category-card p-4">
              <i class="fa-solid fa-basket-shopping fa-3x text-primary mb-3"></i>
              <h5>Kebutuhan Harian</h5>
              <p class="small text-muted">Snack, minuman, dan kebutuhan siswa lainnya.</p>
              <a href="#" class="btn btn-primary btn-sm">Lihat Produk</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
@endsection
