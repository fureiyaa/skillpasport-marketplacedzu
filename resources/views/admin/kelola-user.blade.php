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
    }
    table.dataTable tbody td {
        text-align: center;
        vertical-align: middle;
    }

    /* BADGE ROLE */
    .badge-admin {
        background: var(--primary);
        color: var(--light);
        padding: 6px 12px;
        border-radius: 25px;
    }
    .badge-member {
        background: var(--success);
        color: white;
        padding: 6px 12px;
        border-radius: 25px;
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
        color: white;
        border-color: var(--accent);
    }
    .btn-warning:hover {
        background: #5d6291;
        color: white;
    }

    .btn-danger {
        background: var(--edi);
        border-color: var(--edi);
        color: var(--dark);
    }
    .btn-danger:hover {
        background: #e49a55;
        color: var(--dark);
    }

    .btn-secondary {
        background: var(--secondary);
        border-color: var(--secondary);
        color: white;
    }
    .btn-secondary:hover {
        background: #3b3f5c;
    }

    /* INPUT DATATABLE */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        border: 1px solid #aaa;
        padding: 7px 10px;
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

    /* MODAL HEADERS */
    .modal-header-primary {
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
    .text-primary-custom
</style>

<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card card-custom">
        <div class="card-header modal-header-primary d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Daftar Semua User</h5>

            <button class="btn btn-light text-primary-custom fw-bold"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahUser">
                + Tambah User
            </button>
        </div>

        <div class="card-body px-4">
            <table id="userTable" class="table table-bordered table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $u)
                    <tr>
                        <td>{{ $u->nama }}</td>
                        <td>{{ $u->kontak }}</td>
                        <td>{{ $u->username }}</td>

                        <td>
                            <span class="{{ $u->role == 'admin' ? 'badge-admin' : 'badge-member' }}">
                                {{ ucfirst($u->role) }}
                            </span>
                        </td>

                        <td>
                            <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditUser{{ $u->id }}">
                                Edit
                            </button>

                            <button class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDeleteUser{{ $u->id }}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambahUser">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('admin.user.store') }}">
            @csrf

            <div class="modal-header modal-header-primary">
                <h5>Tambah User</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control mb-3" required>

                <label>Kontak</label>
                <input type="text" name="kontak" class="form-control mb-3" required>

                <label>Username</label>
                <input type="text" name="username" class="form-control mb-3" required>

                <label>Password</label>
                <input type="password" name="password" class="form-control mb-3" required>

                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="member">Member</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit & Delete --}}
@foreach($users as $u)

<div class="modal fade" id="modalEditUser{{ $u->id }}">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('admin.user.update', $u->id) }}">
            @csrf

            <div class="modal-header modal-header-warning">
                <h5>Edit User</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label>Nama</label>
                <input type="text" name="nama" value="{{ $u->nama }}" class="form-control mb-3">

                <label>Kontak</label>
                <input type="text" name="kontak" value="{{ $u->kontak }}" class="form-control mb-3">

                <label>Username</label>
                <input type="text" name="username" value="{{ $u->username }}" class="form-control mb-3">

                <label>Password (opsional)</label>
                <input type="password" name="password" class="form-control mb-3">

                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="member" {{ $u->role == 'member' ? 'selected' : '' }}>Member</option>
                    <option value="admin" {{ $u->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-warning">Update</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalDeleteUser{{ $u->id }}">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('admin.user.delete', $u->id) }}">
            @csrf

            <div class="modal-header modal-header-danger">
                <h5>Hapus User</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>Yakin ingin menghapus user <strong>{{ $u->nama }}</strong>?</p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>

@endforeach

<script>
$(document).ready(function(){
    $('#userTable').DataTable({
        pageLength: 8,
        ordering: true,
        responsive: true,
        columnDefs: [
            { targets: [4], orderable: false }
        ],
        language: {
            search: "Cari User:",
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Data tidak ditemukan",
        }
    });
});
</script>

@endsection
