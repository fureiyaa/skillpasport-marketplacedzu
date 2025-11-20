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

<div class="container mt-3">
    <div class="card card-custom shadow-sm">
        <div class="card-header bg-primary text-white py-3 px-4">
            <h5 class="mb-0 fw-bold">Daftar Semua Produk</h5>
        </div>
        <div class="card-body px-4">
            <table id="tokoTable" class="table table-bordered table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nama Toko</th>
                        <th>Pemilik</th>
                        <th>Kontak</th>
                        <th>Status</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($toko as $t)
                    <tr>
                        <td>{{ $t->nama_toko }}</td>

                        <td>{{ $t->user->nama ?? 'Tidak Ditemukan' }}</td>

                        <td>{{ $t->kontak_toko }}</td>

                        <td>
                            @if ($t->status === 'pending')
                                <span class="badge badge-soft badge-status badge-pending">Pending</span>
                            @elseif ($t->status === 'approved')
                                <span class="badge badge-soft badge-status badge-approved">Approved</span>
                            @else
                                <span class="badge badge-soft badge-status badge-reject">Rejected</span>
                            @endif
                        </td>
                        <td>
                            {{-- STATUS PENDING --}}
                            @if ($t->status === 'pending')
                                <form action="{{ route('admin.toko.approve', $t->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Approve</button>
                                </form>
                                <form action="{{ route('admin.toko.reject', $t->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            {{-- STATUS APPROVED --}}
                            @elseif ($t->status === 'approved')
                                <button class="btn btn-secondary btn-sm" disabled>Disetujui</button>
                                <button class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalHapusToko{{ $t->id }}">
                                    Hapus
                                </button>
                            {{-- STATUS REJECTED --}}
                            @else
                                <span class="badge-status badge-reject">Ditolak</span>
                                <button class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalHapusToko{{ $t->id }}">
                                    Hapus
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


{{-- ===========================
     MODAL HAPUS TOKO
=========================== --}}
@foreach ($toko as $t)
<div class="modal fade" id="modalHapusToko{{ $t->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" method="POST"
              action="{{ route('admin.toko.delete', $t->id) }}">
            @csrf

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Hapus Toko</h5>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p><strong>Pilih alasan menghapus toko ini:</strong></p>

                <select name="alasan" class="form-control" required>
                    <option value="">-- Pilih Alasan --</option>
                    <option value="Informasi toko tidak valid">Informasi toko tidak valid</option>
                    <option value="Melanggar aturan marketplace">Melanggar aturan marketplace</option>
                    <option value="Produk bermasalah / tidak sesuai">Produk bermasalah / tidak sesuai</option>
                    <option value="Konten tidak pantas">Konten tidak pantas</option>
                    <option value="Tindakan penipuan / mencurigakan">Tindakan penipuan / mencurigakan</option>
                </select>

                <p class="small text-muted mt-3">
                    * Alasan ini akan dikirimkan ke pemilik toko.
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Hapus</button>
            </div>

        </form>
    </div>
</div>
@endforeach


{{-- DATATABLES --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function(){
    $('#tokoTable').DataTable({
        "pageLength": 8,
        "ordering": true,
        "info": true,
        "responsive": true,
        "columnDefs": [
            { targets: [4], orderable: false }  // hanya disable kolom aksi
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
