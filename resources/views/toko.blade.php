@extends('template')

@section('content')
<style>
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
                :root {
            --primary: #202250;
            --secondary: #424769;
            --accent: #7077A1;
            --light: #F5DAD2;
            --dark: #2A2A2A;
            --success: #76817A;
            --edi: #F6B17A;
        }
</style>
<div class="all-toko-page container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: var(--primary);">Semua Toko</h2>
    </div>
    <section class="py-5">
            <div class="container">
                <div class="row g-4">
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
    </div>
    {{-- <div class="mt-4 d-flex justify-content-center">
        {{ $toko->links('pagination::bootstrap-5') }}
    </div> --}}

@endsection
