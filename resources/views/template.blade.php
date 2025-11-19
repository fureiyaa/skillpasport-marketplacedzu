<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar ECI Style</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<style>
        /* ======== Top Bar ======== */
        .top-bar {
            background-color: #1e213b;
            color: #ffffff;
            font-size: 14px;
            padding: 6px 0;
        }

        .top-bar a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .top-bar a:hover {
            color: #F6B17A;
        }

        /* ======== Navbar ======== */
        .custom-navbar {
            background-color: #ffffff;
            transition: all 0.4s ease;
            padding: 22px 0;
            box-shadow: none;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        /* Efek saat discroll */
        .custom-navbar.scrolled {
            padding: 12px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            animation: navbarSlide 0.4s ease forwards;
        }

        /* Animasi muncul halus */
        @keyframes navbarSlide {
            0% {
            transform: translateY(-20px);
            opacity: 0.7;
            }
            100% {
            transform: translateY(0);
            opacity: 1;
            }
        }

        /* Warna teks & ikon */
        .navbar-brand, .nav-link, .fa {
            color: #2D3250 !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #F6B17A !important;
        }

        /* Search Bar */
        .search-input {
            border: 2px solid #424769;
            border-radius: 25px;
            padding-left: 15px;
            color: #2D3250;
        }

        .search-input:focus {
            outline: none;
            box-shadow: 0 0 5px #7077A1;
            border-color: #7077A1;
        }

        /* Tombol */
        .btn-peach {
            background-color: #F6B17A;
            border: none;
            color: #2D3250;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-peach:hover {
            background-color: #f8c28f;
        }

        .btn-outline-peach {
            border: 2px solid #F6B17A;
            color: #F6B17A;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-outline-peach:hover {
            background-color: #F6B17A;
            color: #2D3250;
        }
        .footer {
            background-color: var(--primary);
            color: white;
            padding: 40px 0;
        }
</style>
</head>

<body>
  <!-- ======== Top Bar ======== -->
  <div class="top-bar">
    <div class="container">
        <span>
            Halo, Selamat Datang di LapakSIswa! &nbsp;|&nbsp;
        </span>
        <span>
          <i class="fa-solid fa-headset me-2"></i>
          Customer Care 1500032 | Setiap Hari: 09:00–22:00
        </span>
    </div>
  </div>

  <!-- ======== Navbar Section ======== -->
  <nav class="navbar navbar-expand-lg navbar-dark custom-navbar shadow-sm sticky-top">
    <div class="container-fluid px-4">

      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center fw-bold" href="#">
        <img src="{{ asset('asset/image/siswas.png') }}" alt="ECI Logo" class="me-2" style="height: 50px;">
      </a>

      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarECI">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarECI">
        <!-- Search Bar -->
        <form action="{{ route('search') }}" method="GET" class="d-flex w-50 mx-auto">
          <input class="form-control search-input" name="search" type="search" placeholder="Cari produk atau toko..." aria-label="Search">
          <button class="btn btn-peach ms-2" type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>

        <!-- Icons & Auth -->
        <ul class="navbar-nav ms-auto d-flex align-items-center">
          <li class="nav-item">
            <a href="/login" class="btn btn-outline-peach me-2">Masuk/Daftar Member</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<div class="min-vh-100">
    @yield('content')
</div>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <a class="navbar-brand d-flex align-items-center fw-bold" href="#">
                        <img src="{{ asset('asset/image/putihs.png') }}" alt="ECI Logo" class="me-2" style="height: 70px;">
                    </a>
                    <p>Platform jual beli aman untuk siswa di lingkungan sekolah. Dikelola oleh OSIS dengan pengawasan guru.</p>
                    <div class="d-flex">
                        <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-light me-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-light me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6 mb-4">
                    <h5>Menu</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Beranda</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Produk</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Kategori</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Toko</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 mb-4">
                    <h5>Bantuan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Cara Belanja</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Cara Jualan</a></li>
                        <li><a href="#" class="text-light text-decoration-none">FAQ</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5>Kontak Kami</h5>
                    <p><i class="bi bi-geo-alt"></i> Jl. Pendidikan No. 123, Cidugaleun</p>
                    <p><i class="bi bi-envelope"></i> info@lapaksiswa.sch.id</p>
                    <p><i class="bi bi-telephone"></i> (021) 1234-5678</p>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center pt-3">
                <p>&copy; 2025 LapakSiswa. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Navbar Scroll Effect -->
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.custom-navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
        }
    });
  </script>

</body>
</html>
