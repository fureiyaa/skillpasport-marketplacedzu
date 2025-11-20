@extends('admin.template')
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

    .badge-pending {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .badge-approved {
        background: #e5e7eb;
        color: #374151;
    }

    .badge-reject {
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
@section('content')
<div class="container mt-4">
    <div class="card card-custom shadow-sm">
        <div class="card-header bg-primary text-white py-3 px-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Daftar Semua User</h5>

            <button class="btn btn-light text-primary fw-bold"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">
                + Tambah Kategori
            </button>
        </div>
        <div class="card-body px-4">
            <table id="kategoriTable" class="table table-bordered table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Nama</th>
                        <th>Background</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($kategori as $k)
                    <tr>
                        <td><i class="{{ $k->icon }} fs-4"></i></td>
                        <td>{{ $k->nama_kategori }}</td>
                        <td>
                            @if($k->background)
                                <img src="{{ asset('asset/kategori/'.$k->background) }}" width="60" class="rounded">
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <!-- Edit -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $k->id }}">
                                    Edit
                                </button>

                                <!-- Delete -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $k->id }}">
                                    Hapus
                                </button>
                            </div>

                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $k->id }}">
                        <div class="modal-dialog">
                            <form class="modal-content" action="{{ route('admin.kategori.update', $k->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header bg-warning">
                                    <h5>Edit Kategori</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <label>Nama</label>
                                    <input type="text" name="nama_kategori" value="{{ $k->nama_kategori }}" class="form-control mb-3">

                                    <label>Icon FontAwesome</label>
                                    <input type="text" name="icon" value="{{ $k->icon }}" class="form-control mb-3">

                                    <label>Background (optional)</label>
                                    <input type="file" name="background" class="form-control mb-3">

                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button class="btn btn-warning">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>


                    <div class="modal fade" id="modalDelete{{ $k->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                                    <button type="button" class="btn-close btn-close-white"
                                            data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body text-center">
                                    <p class="mb-3">
                                        Apakah Anda yakin ingin menghapus kategori:
                                    </p>

                                    <h5 class="fw-bold text-danger">
                                        {{ $k->nama_kategori }}
                                    </h5>

                                    <p class="text-muted mt-2">
                                        Tindakan ini tidak dapat dibatalkan.
                                    </p>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                    <form action="{{ route('admin.kategori.delete', $k->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger">Hapus Permanen</button>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-header bg-primary text-white">
                <h5>Tambah Kategori</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control mb-3" required>

                <label>Icon FontAwesome</label>
                <input type="text" name="icon" placeholder="fa-solid fa-book" class="form-control mb-3" required>

                <label>Background</label>
                <input type="file" name="background" class="form-control mb-3" required>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan</button>
            </div>

        </form>
    </div>
</div>
<script>
$(document).ready(function(){
    $('#kategoriTable').DataTable({
        "pageLength": 8,
        "ordering": true,
        "info": true,
        "responsive": true,
        "columnDefs": [
            { targets: [3], orderable: false }  // hanya disable kolom aksi
        ],
        "language": {
            "search": "Cari Toko:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "zeroRecords": "Data tidak ditemukan",
        }
    });
});
</script>
@endsection
