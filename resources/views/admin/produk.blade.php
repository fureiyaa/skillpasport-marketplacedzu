@extends('admin.template')
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

    .card-custom {
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 10px rgba(0,0,0,.08);
    }

    /* HEADER TABLE */
    table.dataTable thead th {
        background: var(--primary) !important;
        color: var(--light) !important;
        text-align: center;
        vertical-align: middle;
    }

    table.dataTable tbody td {
        vertical-align: middle;
        text-align: center;
    }

    /* GAMBAR */
    .table-img {
        width: 65px;
        height: 65px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid #eee;
    }

    /* BADGES */
    .badge-soft {
        padding: 6px 12px;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-kat {
        background: var(--light);
        color: var(--accent);
    }

    .badge-toko {
        background: var(--secondary);
        color: white;
    }

    .badge-stok {
        background: var(--edi);
        color: var(--dark);
    }

    /* BUTTONS */
    .btn-danger-custom {
        background: var(--edi);
        border-color: var(--edi);
        color: var(--dark);
        border-radius: 8px;
        padding: 6px 14px;
        font-weight: 600;
    }
    .btn-danger-custom:hover {
        background: #e39850;
        color: var(--dark);
    }

    .btn-secondary-custom {
        background: var(--secondary);
        border-color: var(--secondary);
        color: white;
        border-radius: 8px;
        padding: 6px 14px;
    }

    /* DATATABLES */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        padding: 7px 10px;
        border: 1px solid #aaa;
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 8px;
        border: 1px solid #aaa;
        padding: 4px 6px;
    }

    .dataTables_paginate .paginate_button {
        border-radius: 6px !important;
    }

    /* CARD HEADER */
    .card-header-custom {
        background: var(--primary);
        color: var(--light);
        padding: 14px 20px;
    }

    /* MODAL HEADER */
    .modal-header-custom {
        background: var(--primary);
        color: var(--light);
    }
</style>


<div class="container mt-3">

    <div class="card card-custom">
        <div class="card-header card-header-custom">
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
                                <button class="btn btn-danger-custom btn-sm w-100"
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

                                    <div class="modal-header modal-header-custom">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body text-center">
                                        <p>Yakin ingin menghapus produk:</p>
                                        <h5 class="fw-bold text-danger">{{ $item->nama_produk }}</h5>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary-custom" data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('admin.produk.delete', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger-custom">Hapus</button>
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
        pageLength: 8,
        ordering: true,
        info: true,
        responsive: true,
        columnDefs: [
            { orderable: false, targets: [0, 6] }
        ],
        language: {
            search: "Cari Produk:",
            lengthMenu: "Tampilkan _MENU_ data"
        }
    });
});
</script>

@endsection
