@extends('admin.template')
@section('content')

<style>
    .card-custom {
        border-radius: 12px;
        overflow: hidden;
    }

    table.dataTable thead th {
        background: #1e3a8a !important;
        color: white !important;
        text-align: center;
        vertical-align: middle;
    }

    table.dataTable tbody td {
        vertical-align: middle;
        text-align: center;
    }

    .table-img {
        width: 65px;
        height: 65px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid #eee;
    }

    .badge-soft {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
    }

    .badge-kat {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .badge-toko {
        background: #e5e7eb;
        color: #374151;
    }

    .badge-stok {
        background: #fef3c7;
        color: #92400e;
    }

    .btn-danger {
        border-radius: 8px;
        padding: 6px 14px;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        padding: 7px 10px;
        border: 1px solid #ccc;
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 4px 6px;
    }

    .dataTables_paginate .paginate_button {
        border-radius: 6px !important;
    }
</style>

<div class="container mt-3">

    <div class="card card-custom shadow-sm">
        <div class="card-header bg-primary text-white py-3 px-4">
            <h5 class="mb-0 fw-bold">Daftar Semua Produk</h5>
        </div>

        <div class="card-body px-4">

            <table id="produkTable" class="table table-bordered table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Toko Pemilik</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th width="110">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($produk as $item)
                        @php $gambar = $item->gambar->first(); @endphp

                        <tr>
                            <td>
                                <img src="{{ $gambar ? asset('asset/image/'.$gambar->nama_gambar) : asset('asset/image/placeholder.png') }}"
                                     class="table-img">
                            </td>

                            <td class="fw-semibold">{{ $item->nama_produk }}</td>

                            <td>
                                <span class="badge badge-soft badge-kat">
                                    {{ $item->kategori->nama_kategori }}
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-soft badge-toko">
                                    {{ $item->toko->nama_toko }}
                                </span>
                            </td>

                            <td class="fw-bold text-dark">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>

                            <td>
                                <span class="badge badge-soft badge-stok">
                                    {{ $item->stok }} pcs
                                </span>
                            </td>

                            <td>
                                <button class="btn btn-danger btn-sm w-100"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $item->id }}">
                                    Hapus
                                </button>
                            </td>
                        </tr>


                        {{-- Modal Delete --}}
                        <div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body text-center">
                                        <p>Yakin ingin menghapus produk:</p>
                                        <h5 class="fw-bold text-danger">{{ $item->nama_produk }}</h5>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('admin.produk.delete', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

<script>
$(document).ready(function(){
    $('#produkTable').DataTable({
        "pageLength": 8,
        "ordering": true,
        "info": true,
        "responsive": true,
        "columnDefs": [
            { orderable: false, targets: [0, 6] }
        ],
        "language": {
            "search": "Cari Produk:",
            "lengthMenu": "Tampilkan _MENU_ data"
        }
    });
});
</script>

@endsection
