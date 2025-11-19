@extends('template')

@section('content')

<style>
    .form-wrapper {
        max-width: 650px;
        margin: 40px auto;
        background: white;
        padding: 35px;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        animation: fadeIn .6s ease;
        border: 1px solid #eee;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(15px);}
        to   {opacity: 1; transform: translateY(0);}
    }

    .form-title {
        font-size: 28px;
        font-weight: 700;
        color: #202250;
        text-align: center;
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 600;
        color: #424769;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px;
        border: 1px solid #d7d7d7;
    }

    .form-control:focus {
        border-color: #7077A1;
        box-shadow: 0 0 0 3px rgba(112,119,161,0.2);
    }

    .btn-submit {
        background-color: #202250;
        border-color: #202250;
        padding: 12px;
        border-radius: 12px;
        font-weight: bold;
        transition: .3s;
    }

    .btn-submit:hover {
        background-color: #424769;
    }

    .info-box {
        background: #f8f9ff;
        border-left: 5px solid #202250;
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 25px;
        color: #424769;
    }
</style>

<div class="container">

    <div class="form-wrapper">

        <h3 class="form-title">Daftar Toko Baru</h3>

        {{-- Pesan sukses --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Pesan error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali inputan Anda</strong>
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="info-box">
            Pengajuan toko Anda akan diproses oleh admin terlebih dahulu.
            Jika disetujui, Anda dapat mulai mengelola produk Anda.
        </div>

        <form action="{{ route('toko.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="form-label">Nama Toko</label>
            <input type="text" name="nama_toko" class="form-control mb-3" placeholder="Contoh: Kedai Siswa Maju" required>

            <label class="form-label">Deskripsi Toko</label>
            <textarea name="deskripsi" class="form-control mb-3" rows="3"
            placeholder="Deskripsikan toko Anda..."></textarea>

            <label class="form-label">Kontak WhatsApp</label>
            <input type="text" name="kontak_toko" class="form-control mb-3" placeholder="08xxxxxxxxxx" required>

            <label class="form-label">Logo / Foto Toko</label>
            <input type="file" name="gambar" class="form-control mb-4" accept="image/*">

            <button class="btn btn-primary btn-submit w-100">
                Kirim Pengajuan
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="/" class="text-muted">← Kembali ke Beranda</a>
        </div>

    </div>

</div>

@endsection
