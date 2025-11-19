@extends('admin.template')
@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Kelola Produk</h3>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Semua Produk</h5>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="80">Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Toko Pemilik</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($produk as $item)
                        @php $gambar = $item->gambar->first(); @endphp

                        <tr>
                            <td>
                                <img src="{{ $gambar ? asset('asset/image/'.$gambar->nama_gambar) : asset('asset/image/placeholder.png') }}"
                                     style="width: 70px; height: 70px; object-fit: cover;"
                                     class="rounded">
                            </td>

                            <td>{{ $item->nama_produk }}</td>
                            <td>
                                <span class="badge bg-info">
                                    {{ $item->kategori->nama_kategori }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-secondary">
                                    {{ $item->toko->nama_toko }}
                                </span>
                            </td>

                            <td>
                                <strong>Rp {{ number_format($item->harga, 0, ',', '.') }}</strong>
                            </td>

                            <td>
                                <span class="badge bg-warning text-dark">
                                    {{ $item->stok }} pcs
                                </span>
                            </td>

                            <td>
                                <form action="{{ route('admin.produk.delete', $item->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    <button class="btn btn-danger btn-sm w-100">Hapus</button>
                                </form>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
