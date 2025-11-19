@extends('admin.template')
@section('content')
<h3 class="mb-4">Pengajuan Toko Baru</h3>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Toko</th>
                    <th>Pemilik</th>
                    <th>Kontak</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pending as $t)
                <tr>
                    <td>{{ $t->nama_toko }}</td>
                    <td>{{ $t->user->nama ?? 'Pengguna Tidak Login' }}</td>
                    <td>{{ $t->kontak_toko }}</td>
                    <td><span class="badge bg-warning">Pending</span></td>
                    <td>
                        <form action="{{ route('admin.toko.approve', $t->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>

                        <form action="{{ route('admin.toko.reject', $t->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
