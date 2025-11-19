<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Panel - LapakSiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --primary: #202250;
            --secondary: #424769;
            --accent: #7077A1;
            --light: #F5F7FA;
        }

        body {
            margin: 0;
            background: #f6f7fb;
            font-family: 'Segoe UI', sans-serif;
        }

        /* SIDEBAR STYLE */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 25px 20px;
            background: var(--primary);
            color: white;
            display: flex;
            flex-direction: column;
        }

        .sidebar .logo img {
            width: 140px;
            margin: 0 auto 30px;
            display: block;
        }

        .sidebar .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: #ffffffd9;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            border-radius: 10px;
            margin-bottom: 8px;
            transition: .2s ease;
        }

        .sidebar .menu a i {
            font-size: 18px;
        }

        .sidebar .menu a:hover,
        .sidebar .menu a.active {
            background: var(--secondary);
            color: white;
        }

        .logout-btn {
            margin-top: auto;
            color: #ffb4b4 !important;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.15) !important;
        }

        /* CONTENT */
        .content {
            margin-left: 260px;
            padding: 30px;
        }
    </style>
</head>
<body>
<div class="sidebar">

    <div class="logo text-center">
        <img src="{{ asset('asset/image/putihs.png') }}" alt="Logo">
        <h5>Admin Panel</h5>
    </div>
    <div class="menu">
        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a>

        <a href="{{ route('admin.pengajuan-toko') }}"
           class="{{ request()->routeIs('admin.pengajuan-toko') ? 'active' : '' }}">
            <i class="fa-solid fa-box"></i> Kelola Toko
        </a>

        <a href="{{ route('admin.produk') }}"
           class="{{ request()->routeIs('admin.produk') ? 'active' : '' }}">
            <i class="fa-solid fa-box"></i> Kelola Produk
        </a>
        <form action="{{ route('logout') }}" method="POST" class="w-100">
            @csrf
            <button class="btn w-100 text-start logout-btn" style="background: none; border: none;">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>

    </div>
</div>

<!-- MAIN CONTENT -->
<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
