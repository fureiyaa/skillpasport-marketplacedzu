@extends('member.template')
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
    .card { border: none; box-shadow: 0 4px 6px rgba(0,0,0,.1); }
    .card:hover { transform: translateY(-3px); }
    .btn-primary { background: var(--primary); border-color: var(--primary); }
    .btn-primary:hover { background: var(--edi); color: var(--primary); }
</style>

<div class="container">
@if(isset($notif) && $notif)
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Pemberitahuan!</strong><br>
        {{ $notif->pesan }}

        <form action="{{ route('member.notif.clear', $notif->id) }}" method="POST" class="mt-2">
            @csrf
            <button class="btn btn-sm btn-outline-light">Tandai Sudah Dibaca</button>
        </form>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
    {{-- ===========================
         1. STATUS PENDING
    ============================ --}}
    @if ($toko && $toko->status === 'pending')

        <div class="card shadow-sm p-4 text-center mt-4">
            <h4 class="text-warning mb-3">Toko Anda Sedang Ditinjau</h4>
            <p class="text-muted">Pengajuan toko Anda telah diterima.</p>
            <p class="text-muted">Silakan menunggu persetujuan admin.</p>

            <img src="{{ asset('asset/image/pending.png') }}" width="180">
        </div>

    {{-- ===========================
         2. BELUM PUNYA TOKO
    ============================ --}}
    @elseif (!$toko)

        <div class="card shadow-sm p-4 text-center mt-4">
            <h4 class="mb-3">Anda Belum Memiliki Toko</h4>
            <p class="text-muted mb-4">Untuk mulai berjualan, ajukan pembuatan toko.</p>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBuatToko">
                + Ajukan Pembuatan Toko
            </button>
        </div>

        {{-- Modal Buat Toko --}}
        <div class="modal fade" id="modalBuatToko" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content" action="{{ route('toko.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Pengajuan Toko Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <label class="fw-bold">Nama Toko</label>
                        <input type="text" name="nama_toko" class="form-control mb-3" required>

                        <label class="fw-bold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control mb-3" rows="3" required></textarea>

                        <label class="fw-bold">Alamat</label>
                        <textarea name="alamat" class="form-control mb-3" rows="3" required></textarea>

                        <label class="fw-bold">Kontak</label>
                        <input type="text" name="kontak_toko" class="form-control mb-3" required>

                        <label class="fw-bold">Logo Toko</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Kirim Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>

    {{-- ===========================
         3. STATUS REJECTED
    ============================ --}}
    @elseif ($toko && $toko->status === 'rejected')

        <div class="card shadow-sm p-4 text-center mt-4">
            <h4 class="text-danger mb-3">Pengajuan Toko Ditolak</h4>
            <p class="text-muted">Silakan ajukan ulang pembuatan toko.</p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBuatToko">
                Ajukan Ulang
            </button>
        </div>

    {{-- ===========================
         4. STATUS APPROVED (TAMPIL TOKO)
    ============================ --}}
    @elseif ($toko && $toko->status === 'approved')

        {{-- === INFORMASI TOKO === --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white"><h5>Informasi Toko Anda</h5></div>

            <div class="card-body">
                <form action="{{ route('toko.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            @if ($toko->gambar)
                                <img src="{{ asset('asset/image/' . $toko->gambar) }}" class="img-fluid rounded">
                            @else
                                <img src="{{ asset('asset/image/siswas.png') }}" class="img-fluid rounded">
                            @endif
                        </div>

                        <div class="col-md-8">
                            <label>Nama Toko</label>
                            <input type="text" name="nama_toko" class="form-control mb-2" value="{{ $toko->nama_toko }}">

                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control mb-2" rows="3">{{ $toko->deskripsi }}</textarea>

                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control mb-2" rows="3">{{ $toko->alamat }}</textarea>

                            <label>Kontak</label>
                            <input type="text" name="kontak_toko" class="form-control mb-3" value="{{ $toko->kontak_toko }}">

                            <button class="btn btn-primary">Update Toko</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        {{-- === PRODUK === --}}
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between">
                <h5>Produk Anda</h5>
                <button class="btn btn-light btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
                    + Tambah Produk
                </button>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    @forelse ($produk as $item)
                        @php $img = $item->gambar->first(); @endphp

                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="card h-100">
                                <img src="{{ $img ? asset('asset/image/'.$img->nama_gambar) : asset('asset/image/placeholder.png') }}"
                                     class="card-img-top" style="height:250px; object-fit:cover;">

                                <div class="card-body">
                                    <h6 class="mb-1">{{ $item->nama_produk }}</h6>
                                    <strong>Rp {{ number_format($item->harga,0,',','.') }}</strong>
                                </div>
                            </div>
                        </div>

                    @empty
                        <p class="text-center text-muted">Belum ada produk.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Modal Tambah Produk --}}
        <div class="modal fade" id="modalTambahProduk" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <form class="modal-content" action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header bg-primary text-white">
                        <h5>Tambah Produk Baru</h5>
                        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control mb-3" required>

                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control mb-3" required>

                        <label>Kategori</label>
                        <select name="kategori_id" class="form-control mb-3">
                            @foreach (\App\Models\Kategori::all() as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>

                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control mb-3" rows="3" required></textarea>
                        <label>Stok Produk</label>
                        <input type="number" name="stok" class="form-control mb-3" required>
                        <label>Gambar Produk</label>
                        <input type="file" name="gambar[]" multiple class="form-control mb-3" required>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    @endif
</div>

@endsection
