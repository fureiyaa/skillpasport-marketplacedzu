@extends('template') {{-- kalau template berbeda, sesuaikan --}}

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
    .produk-img {
        width: 100%;
        height: 420px;
        object-fit: cover;
        border-radius: 12px;
    }
    .thumb {
        width: 85px;
        height: 85px;
        object-fit: cover;
        border-radius: 10px;
        cursor: pointer;
        border: 2px solid transparent;
    }
    .thumb:hover {
        border-color: #202250;
    }
    .harga{
        color: var(--edi)
    }
    .box {
        background: white;
        padding: 22px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.07);
    }
    .badge-cat {
        background: #7077A1;
        color: white;
        padding: 6px 12px;
        border-radius: 7px;
    }
</style>

<div class="container py-4">

    {{-- FOTO + DETAIL PRODUK --}}
    <div class="row">

        {{-- GALERI FOTO --}}
        <div class="col-md-6 mb-4">
            <div class="box mb-3">
                @php $fotoUtama = $produk->gambar->first(); @endphp

                <img id="fotoPreview"
                     src="{{ $fotoUtama ? asset('asset/image/'.$fotoUtama->nama_gambar) : asset('asset/image/placeholder.png') }}"
                     class="produk-img">
            </div>

            <div class="d-flex gap-2 flex-wrap">
                @foreach ($produk->gambar as $gmbr)
                    <img src="{{ asset('asset/image/'.$gmbr->nama_gambar) }}"
                         class="thumb"
                         onclick="document.getElementById('fotoPreview').src=this.src;">
                @endforeach
            </div>
        </div>

        {{-- INFORMASI PRODUK --}}
        <div class="col-md-6">

            <div class="box">

                <span class=" badge badge-cat mb-2 d-inline-block px-3 py-1 rounded-pill">
                    {{ $produk->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                </span>

                <h2 class="fw-bold mt-2">{{ $produk->nama_produk }}</h2>

                <h3 class="harga fw-bold mb-4">
                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                </h3>
                <span class="badge bg-secondary mb-4 d-inline-block px-3 py-1 rounded-pill">
                    Stok: {{ $produk->stok }}
                </span>

                <!-- Info Toko -->
                <div class="d-flex justify-content-between">
                    <div class="toko d-flex align-items-center mb-4">
                        <img src="{{ asset('asset/image/' . $produk->toko->gambar) }}"
                            class="rounded-circle"
                            alt="Toko"
                            style="width: 45px; height: 45px; object-fit: cover;">

                        <div class="ms-3">
                            <p class="mb-0 fw-semibold">{{ $produk->toko->nama_toko }}</p>
                            <small class="text-muted">Penjual Terpercaya</small>
                        </div>
                    </div>
                    <div class="kunjungi">
                        <a href="{{ route('toko.detail', $produk->toko->id) }}" class="btn btn-outline-primary mt-3">Kunjungi Toko</a>
                    </div>

                </div>

                <!-- Tombol WA -->
                <a href="https://wa.me/{{ $produk->toko->kontak_toko }}?text=Halo,%20saya%20ingin%20bertanya%20tentang%20produk%20{{ urlencode($produk->nama_produk) }}"
                target="_blank"
                class="btn btn-success px-4 py-2 w-100 fw-semibold">
                    <i class="fa-brands fa-whatsapp me-2"></i> Hubungi Penjual
                </a>

            </div>


        </div>

    </div>


    {{-- DESKRIPSI --}}
    <div class="box mt-4">
        <h4 class="fw-bold mb-2">Deskripsi Produk</h4>
        <p style="white-space: pre-line;">{{ $produk->deskripsi }}</p>
    </div>



    {{-- PRODUK LAIN DARI TOKO SAMA --}}
    @if (count($produk_lain) > 0)
    <h4 class="fw-bold mt-5 mb-3">Produk Lain dari Toko Ini</h4>

    <div class="row g-4">

        @foreach ($produk_lain as $item)
            @php $img = $item->gambar->first(); @endphp

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

        @endforeach

    </div>
    @endif

</div>

@endsection
