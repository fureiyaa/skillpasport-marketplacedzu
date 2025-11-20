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
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="card card-custom shadow-sm">
        <div class="card-header bg-primary text-white py-3 px-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Daftar Semua User</h5>

            <button class="btn btn-light text-primary fw-bold"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahUser">
                + Tambah User
            </button>
        </div>
        <div class="card-body px-4">
            <table id="userTable" class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-light">
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
                            <span class="badge {{ $u->role == 'admin' ? 'bg-primary' : 'bg-success' }}">
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


{{-- =============================
     MODAL TAMBAH USER
============================== --}}
<div class="modal fade" id="modalTambahUser">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('admin.user.store') }}">
            @csrf

            <div class="modal-header bg-primary text-white">
                <h5>Tambah User</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control mb-2" required>

                <label>Kontak</label>
                <input type="text" name="kontak" class="form-control mb-2" required>

                <label>Username</label>
                <input type="text" name="username" class="form-control mb-2" required>

                <label>Password</label>
                <input type="password" name="password" class="form-control mb-2" required>

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


{{-- =============================
     MODAL EDIT & DELETE USER
============================== --}}
@foreach($users as $u)

{{-- Modal Edit --}}
<div class="modal fade" id="modalEditUser{{ $u->id }}">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('admin.user.update', $u->id) }}">
            @csrf

            <div class="modal-header bg-warning">
                <h5>Edit User</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control mb-2" value="{{ $u->nama }}" required>

                <label>Kontak</label>
                <input type="text" name="kontak" class="form-control mb-2" value="{{ $u->kontak }}" required>

                <label>Username</label>
                <input type="text" name="username" class="form-control mb-2" value="{{ $u->username }}" required>

                <label>Password (kosongkan jika tidak diganti)</label>
                <input type="password" name="password" class="form-control mb-2">

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

{{-- Modal Delete --}}
<div class="modal fade" id="modalDeleteUser{{ $u->id }}">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('admin.user.delete', $u->id) }}">
            @csrf

            <div class="modal-header bg-danger text-white">
                <h5>Hapus User</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus user <strong>{{ $u->nama }}</strong>?</p>
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
