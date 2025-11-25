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
    --edi: #F6B17A;
}

.card {
    border: none;
    border-radius: 14px;
    box-shadow: 0 4px 10px rgba(0,0,0,.12);
    transition: .2s;
}
.card:hover { transform: translateY(-3px); }

.card-header {
    background: var(--primary) !important;
    border-radius: 14px 14px 0 0 !important;
}

.btn-primary {
    background: var(--primary);
    border-color: var(--primary);
}
.btn-primary:hover {
    background: var(--edi);
    color: var(--primary);
}

.alert-custom {
    background: var(--edi);
    border: none;
    color: var(--dark);
    font-weight: 600;
    border-radius: 10px;
}

.badge-status {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
}
</style>

<div class="container">
@if(isset($notif) && $notif)
    <div class="alert alert-custom alert-dismissible fade show mt-3" role="alert">
        <strong> Pemberitahuan!</strong><br>
        {{ $notif->pesan }}

        <form action="{{ route('member.notif.clear', $notif->id) }}" method="POST" class="mt-2">
            @csrf
            <button class="btn btn-sm" style="background: var(--primary); color:white;">Tandai Sudah Dibaca</button>
        </form>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif


@if ($toko && $toko->status === 'pending')
    <div class="card p-4 text-center mt-4">
        <h4 class="mb-3" style="color: var(--accent);">Toko Anda Sedang Ditinjau</h4>
        <p class="text-muted">Pengajuan toko Anda telah diterima dan sedang menunggu persetujuan admin.</p>

        {{-- <img src="{{ asset('asset/image/pending.png') }}" width="180"> --}}
    </div>


@elseif (!$toko)
    <div class="card p-4 text-center mt-4">
        <h4 style="color: var(--primary);" class="mb-3">Anda Belum Memiliki Toko</h4>
        <p class="text-muted mb-4">Mulai berjualan dengan membuat toko sekarang.</p>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBuatToko">
            + Ajukan Pembuatan Toko
        </button>
    </div>

    <div class="modal fade" id="modalBuatToko">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('toko.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header" style="background: var(--primary); color:white;">
                    <h5>Pengajuan Toko Baru</h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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

@elseif ($toko && $toko->status === 'rejected')
    <div class="card p-4 text-center mt-4">
        <h4 class="text-danger mb-3">Pengajuan Toko Ditolak</h4>
        <p class="text-muted">Silakan ajukan ulang pembuatan toko.</p>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBuatToko">
            Ajukan Ulang
        </button>
    </div>

@elseif ($toko && $toko->status === 'approved')
    <div class="card mb-4">
        <div class="card-header text-white"><h5>Informasi Toko Anda</h5></div>

        <div class="card-body">
            <form action="{{ route('toko.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-4">
                        <img src="{{ $toko->gambar ? asset('asset/image/'.$toko->gambar) : asset('asset/image/siswas.png') }}"
                             class="img-fluid rounded">
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


<div class="card">
    <div class="card-header text-white d-flex justify-content-between">
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
                    <div class="card h-100 position-relative">
                        <img src="{{ $img ? asset('asset/image/'.$img->nama_gambar) : asset('asset/image/placeholder.png') }}"
                             class="card-img-top"
                             style="height:250px; object-fit:cover; border-radius:14px 14px 0 0;">
                        <div class="card-body">
                            <h6 class="mb-1" style="color:var(--dark)">{{ $item->nama_produk }}</h6>
                            <strong style="color:var(--primary)">
                                Rp {{ number_format($item->harga,0,',','.') }}
                            </strong>
                        </div>
                        <div class="p-3 d-flex gap-2">
                            <button class="btn btn-warning btn-sm w-50"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditProduk{{ $item->id }}">
                                Edit
                            </button>

                            <button class="btn btn-danger btn-sm w-50"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalHapusProduk{{ $item->id }}">
                                Hapus
                            </button>
                        </div>

                    </div>
                </div>

                <div class="modal fade" id="modalEditProduk{{ $item->id }}">
                    <div class="modal-dialog modal-lg">
                        <form class="modal-content" method="POST"
                              enctype="multipart/form-data"
                              action="{{ route('produk.update', $item->id) }}">
                            @csrf

                            <div class="modal-header" style="background: var(--edi); color:white;">
                                <h5>Edit Produk</h5>
                                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk"
                                       class="form-control mb-3"
                                       value="{{ $item->nama_produk }}" required>

                                <label>Harga</label>
                                <input type="number" name="harga"
                                       class="form-control mb-3"
                                       value="{{ $item->harga }}" required>

                                <label>Kategori</label>
                                <select name="kategori_id" class="form-control mb-3">
                                    @foreach (\App\Models\Kategori::all() as $k)
                                        <option value="{{ $k->id }}"
                                            {{ $k->id == $item->kategori_id ? 'selected' : '' }}>
                                            {{ $k->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>

                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control mb-3" rows="3">{{ $item->deskripsi }}</textarea>

                                <label>Stok Produk</label>
                                <input type="number" name="stok"
                                       class="form-control mb-3"
                                       value="{{ $item->stok }}" required>

                                <label>Gambar Baru (opsional)</label>
                                <input type="file" name="gambar[]" multiple class="form-control mb-3">

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-warning">Update</button>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="modal fade" id="modalHapusProduk{{ $item->id }}">
                    <div class="modal-dialog">
                        <form class="modal-content" method="POST"
                              action="{{ route('produk.delete', $item->id) }}">
                            @csrf

                            <div class="modal-header bg-danger text-white">
                                <h5>Hapus Produk</h5>
                                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body text-center">
                                <p>Yakin ingin menghapus produk:</p>
                                <h5 class="fw-bold text-danger">{{ $item->nama_produk }}</h5>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-danger">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>

            @empty
                <p class="text-center text-muted">Belum ada produk.</p>
            @endforelse

        </div>
    </div>
</div>



    <div class="modal fade" id="modalTambahProduk">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header" style="background: var(--primary); color:white;">
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
