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
    }

    table.dataTable tbody td {
        text-align: center;
        vertical-align: middle;
    }

    /* BADGE */
    .badge-soft {
        padding: 6px 12px;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-pending {
        background: var(--light);
        color: var(--primary);
    }

    .badge-approved {
        background: var(--success);
        color: white;
    }

    .badge-reject {
        background: var(--edi);
        color: var(--dark);
    }

    /* BUTTONS */
    .btn-primary {
        background: var(--primary);
        border-color: var(--primary);
    }

    .btn-primary:hover {
        background: var(--edi);
        color: var(--dark);
        border-color: var(--edi);
    }

    .btn-warning {
        background: var(--accent);
        border-color: var(--accent);
        color: white;
    }
    .btn-warning:hover {
        background: #5e6291;
        color: white;
    }

    .btn-danger {
        background: var(--edi);
        border-color: var(--edi);
        color: var(--dark);
    }
    .btn-danger:hover {
        background: #db9652;
        color: var(--dark);
    }

    .btn-secondary {
        background: var(--secondary);
        border-color: var(--secondary);
        color: white;
    }
    .btn-secondary:hover {
        background: #3b3f5c;
        color: white;
    }

    /* INPUT DATATABLE */
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

    /* PAGINATION */
    .dataTables_paginate .paginate_button {
        border-radius: 6px !important;
    }

    /* CARD HEADER */
    .header-custom {
        background: var(--primary);
        color: var(--light);
        padding: 14px 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* MODAL */
    .modal-header-custom {
        background: var(--primary);
        color: var(--light);
    }

    .modal-header-warning {
        background: var(--accent);
        color: white;
    }

    .modal-header-danger {
        background: var(--edi);
        color: var(--dark);
    }
    .text-primary-custom {
        color: var(--primary)
    }
</style>

<div class="container mt-4">

    <div class="card card-custom">
        <div class="header-custom">
            <h5 class="fw-bold mb-0">Daftar Semua Kategori</h5>

            <button class="btn btn-light text-primary-custom fw-bold"
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
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($kategori as $k)
                    <tr>
                        <td><i class="{{ $k->icon }} fs-4"></i></td>
                        <td>{{ $k->nama_kategori }}</td>
                        <td>
                            @if($k->background)
                                <img src="{{ asset('asset/kategori/'.$k->background) }}"
                                     width="60" class="rounded shadow-sm">
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1 justify-content-center">
                                <button class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $k->id }}">
                                    Edit
                                </button>

                                <button class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $k->id }}">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $k->id }}">
                        <div class="modal-dialog">
                            <form class="modal-content"
                                  action="{{ route('admin.kategori.update', $k->id) }}"
                                  method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="modal-header modal-header-warning">
                                    <h5>Edit Kategori</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <label>Nama</label>
                                    <input type="text" name="nama_kategori"
                                           value="{{ $k->nama_kategori }}" class="form-control mb-3">

                                    <label>Icon FontAwesome</label>
                                    <input type="text" name="icon"
                                           value="{{ $k->icon }}" class="form-control mb-3">

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


                    <!-- Modal Delete -->
                    <div class="modal fade" id="modalDelete{{ $k->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header modal-header-danger">
                                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                                    <button type="button" class="btn-close"
                                            data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body text-center">
                                    <p>Apakah Anda yakin ingin menghapus:</p>

                                    <h5 class="fw-bold text-danger">{{ $k->nama_kategori }}</h5>

                                    <p class="text-muted mt-2">
                                        Tindakan ini tidak dapat dibatalkan.
                                    </p>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                    <form action="{{ route('admin.kategori.delete', $k->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
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

            <div class="modal-header modal-header-custom">
                <h5>Tambah Kategori</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control mb-3" required>

                <label>Icon FontAwesome</label>
                <input type="text" name="icon" placeholder="fa-solid fa-book"
                       class="form-control mb-3" required>

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
        pageLength: 8,
        ordering: true,
        responsive: true,
        columnDefs: [
            { targets: [3], orderable: false }
        ],
        language: {
            search: "Cari Kategori:",
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Data tidak ditemukan",
        }
    });
});
</script>

@endsection
