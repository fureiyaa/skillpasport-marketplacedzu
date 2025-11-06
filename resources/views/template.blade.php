<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar ECI Style</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    .top-bar {
        background-color: #1e213b;
        color: #ffffff;
        font-size: 14px;
        padding: 6px 0;
    }

    .top-bar .container {
        width: 100%;
        margin: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .top-bar a {
        color: var(--accent);
        text-decoration: none;
        transition: color 0.3s;
    }

    .top-bar a:hover {
        color: var(--light-blue);
    }
    /* ======== Navbar Custom Style ======== */
    .custom-navbar {
      background-color: #ffffff;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .custom-navbar.scrolled {
      background-color: #1e213b;
      box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .navbar-brand {
      color: #F6B17A !important;
      font-size: 1.3rem;
      letter-spacing: 0.5px;
    }

    .text-peach {
      color: #F6B17A !important;
    }

    .nav-link {
      color: #E0E0E0 !important;
      transition: color 0.3s ease;
      font-weight: 500;
    }

    .nav-link:hover {
      color: #F6B17A !important;
    }

    /* Search Input */
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

    /* Buttons */
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

    /* Badge */
    .bg-peach {
      background-color: #F6B17A !important;
    }
  </style>
</head>

<body>
    <div class="top-bar">
        <div class="container">
            <span><i class="fa-solid fa-headset me-2"></i>Customer Care 1500032 | Setiap Hari: 09:00–22:00</span>
            <a href="#"><i class="fa-solid fa-building me-1"></i>Corporate</a>
        </div>
    </div>
  <!-- ======== Navbar Section ======== -->
  <nav class="navbar navbar-expand-lg navbar-dark custom-navbar shadow-sm sticky-top">
    <div class="container-fluid px-4">
      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center fw-bold" href="#">
        <i class="fa-solid fa-bolt me-2 text-peach"></i>
        ECI Market
      </a>

      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarECI">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarECI">
        <!-- Search Bar -->
        <form class="d-flex mx-auto w-50">
          <input class="form-control search-input" type="search" placeholder="Cari produk elektronik..." aria-label="Search">
          <button class="btn btn-peach ms-2" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <!-- Icons & Auth -->
        <ul class="navbar-nav ms-auto d-flex align-items-center">
          <li class="nav-item me-3">
            <a href="#" class="nav-link"><i class="fa-regular fa-envelope fs-5"></i></a>
          </li>
          <li class="nav-item me-3">
            <a href="#" class="nav-link"><i class="fa-regular fa-heart fs-5"></i></a>
          </li>
          <li class="nav-item me-3 position-relative">
            <a href="#" class="nav-link">
              <i class="fa-solid fa-cart-shopping fs-5"></i>
              <span class="badge bg-peach text-dark position-absolute top-0 start-100 translate-middle p-1 rounded-pill">3</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="btn btn-outline-peach me-2">Masuk</a>
            <a href="#" class="btn btn-peach text-dark fw-semibold">Daftar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Navbar Scroll Effect -->
  <script>
    window.addEventListener('scroll', function() {
      const navbar = document.querySelector('.custom-navbar');
      navbar.classList.toggle('scrolled', window.scrollY > 50);
    });
  </script>
</body>
</html>
