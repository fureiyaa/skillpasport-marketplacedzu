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

    .badge-soft {
        padding: 6px 12px;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-pending { background: var(--light); color: var(--accent); }
    .badge-approved { background: var(--success); color: white; }
    .badge-reject { background: var(--edi); color: var(--dark); }

    .btn-primary-custom {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }
    .btn-primary-custom:hover {
        background: var(--edi);
        color: var(--primary);
    }

    .btn-danger-custom {
        background: var(--edi);
        border-color: var(--edi);
        color: var(--dark);
        border-radius: 8px;
        padding: 6px 14px;
    }
    .btn-danger-custom:hover {
        background: #e89c55;
        color: var(--dark);
    }

    .btn-secondary-custom {
        background: var(--secondary);
        border-color: var(--secondary);
        color: white;
        border-radius: 8px;
        padding: 6px 14px;
    }

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

    .modal-header-custom {
        background: var(--primary);
        color: white;
    }
</style>

<div class="container mt-3">
    <div class="card card-custom shadow-sm">
        <div class="card-header py-3 px-4" style="background: var(--primary); color:white;">
            <h5 class="mb-0 fw-bold">Daftar Semua Toko</h5>
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
                                <span class="badge-soft badge-pending">Pending</span>
                            @elseif ($t->status === 'approved')
                                <span class="badge-soft badge-approved">Approved</span>
                            @else
                                <span class="badge-soft badge-reject">Rejected</span>
                            @endif
                        </td>

                        <td>
                            @if ($t->status === 'pending')
                                <form action="{{ route('admin.toko.approve', $t->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-primary-custom btn-sm">Approve</button>
                                </form>

                                <form action="{{ route('admin.toko.reject', $t->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger-custom btn-sm">Reject</button>
                                </form>

                            @elseif ($t->status === 'approved')
                                <button class="btn btn-secondary-custom btn-sm" disabled>Disetujui</button>

                                <button class="btn btn-danger-custom btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalHapusToko{{ $t->id }}">
                                    Hapus
                                </button>

                            @else
                                <span class="badge badge-reject">Ditolak</span>

                                <button class="btn btn-danger-custom btn-sm"
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

@foreach ($toko as $t)
<div class="modal fade" id="modalHapusToko{{ $t->id }}">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('admin.toko.delete', $t->id) }}">
            @csrf

            <div class="modal-header modal-header-custom">
                <h5 class="modal-title">Hapus Toko</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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

                <p class="small mt-3" style="color: var(--dark);">
                    * Alasan ini akan dikirimkan ke pemilik toko.
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary-custom" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-danger-custom">Hapus</button>
            </div>

        </form>
    </div>
</div>
@endforeach


{{-- DATATABLE --}}
<script>
$(document).ready(function(){
    $('#tokoTable').DataTable({
        pageLength: 8,
        ordering: true,
        responsive: true,
        columnDefs: [
            { targets: [4], orderable: false }
        ],
        language: {
            search: "Cari Toko:",
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Data tidak ditemukan"
        }
    });
});
</script>

@endsection
