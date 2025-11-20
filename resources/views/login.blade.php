@extends('template')

@section('content')
<style>
    .login-section {
        min-height: 85vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f5f6fa;
    }
    .login-card {
        width: 420px;
        background: white;
        border-radius: 14px;
        padding: 35px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        animation: fadeIn .5s ease;
    }
    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(10px);}
        to {opacity: 1; transform: translateY(0);}
    }
    .login-title {
        font-size: 26px;
        font-weight: 700;
        color: #202250;
    }
    .form-control {
        padding: 12px;
        border-radius: 10px;
    }
    .btn-login {
        background-color: #202250;
        border-color: #202250;
        padding: 12px;
        font-weight: bold;
        border-radius: 10px;
    }
    .btn-login:hover {
        background-color: #424769;
    }
</style>

<section class="login-section">
    <div class="login-card">

        {{-- LOGO --}}
        <div class="text-center mb-5">
            <img src="{{ asset('asset/image/siswas.png') }}" height="80">
        </div>

        <h3 class="text-center login-title mb-4">Masuk ke Akun Anda</h3>

        {{-- ERROR ALERT --}}
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- SUCCESS ALERT --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <label>Username</label>
            <input type="text"
                name="username"
                class="form-control mb-3"
                placeholder="Masukkan username..."
                required>

            <label>Password</label>
            <input type="password"
                name="password"
                class="form-control mb-4"
                placeholder="Masukkan password..."
                required>

            <button class="btn btn-primary btn-login w-100">
                Masuk
            </button>
        </form>
        <a href="/register" class="text-dark">Belum punya akun? Daftar di sini</a>


        <div class="text-center mt-3">
            <a href="/" class="text-muted">← Kembali ke Beranda</a>
        </div>

    </div>
</section>

@endsection
