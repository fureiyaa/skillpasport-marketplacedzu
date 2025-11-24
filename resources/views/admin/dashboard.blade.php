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

/* CARD STAT */
.card-stat {
    border-radius: 14px;
    padding: 22px;
    color: white;
    box-shadow: 0 4px 10px rgba(0,0,0,.15);
    transition: .2s;
}
.card-stat:hover {
    transform: translateY(-3px);
}

.stat-title {
    font-size: 14px;
    opacity: .9;
}
.stat-value {
    font-size: 30px;
    font-weight: 750;
}

/* TABLE */
.table thead {
    background: var(--primary);
    color: white;
}
.table td, .table th {
    vertical-align: middle;
    text-align: center;
}

/* CARD GENERAL */
.card {
    border: none;
    border-radius: 14px;
    box-shadow: 0 4px 10px rgba(0,0,0,.12);
}

/* HEADER CARD */
.card-header {
    background: var(--primary) !important;
    color: white !important;
    border-radius: 14px 14px 0 0 !important;
}
</style>

<div class="container mt-3">
    <h3 class="fw-bold mb-4" style="color: var(--primary);">Dashboard Admin</h3>
    <div class="row g-4">

        <div class="col-md-3">
            <div class="card-stat" style="background: var(--primary);">
                <div class="stat-title">Total User</div>
                <div class="stat-value">{{ $total_user }}</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-stat" style="background: var(--success);">
                <div class="stat-title">Total Toko</div>
                <div class="stat-value">{{ $total_toko }}</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-stat" style="background: var(--edi); color: var(--primary);">
                <div class="stat-title">Pengajuan Pending</div>
                <div class="stat-value">{{ $pending_toko }}</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-stat" style="background: #D9534F;">
                <div class="stat-title">Total Produk</div>
                <div class="stat-value">{{ $total_produk }}</div>
            </div>
        </div>

    </div>

    <div class="card shadow-sm mt-4 p-4">
        <h5 class="fw-bold mb-3" style="color: var(--primary);">Grafik Produk per Kategori</h5>
        <canvas id="chartKategori" height="120"></canvas>
    </div>

    <div class="card shadow-sm mt-4 mb-5">
        <div class="card-header fw-bold">
            Pengajuan Toko Pending
        </div>

        <div class="card-body">

            @if($pending_list->count() == 0)
                <p class="text-muted text-center">Tidak ada pengajuan toko yang pending.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Toko</th>
                            <th>Pemilik</th>
                            <th>Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pending_list as $p)
                        <tr>
                            <td>{{ $p->nama_toko }}</td>
                            <td>{{ $p->user->nama }}</td>
                            <td>{{ $p->kontak_toko }}</td>
                            <td>
                                <a href="{{ route('admin.pengajuan-toko') }}"
                                    class="btn btn-primary btn-sm">
                                    Review
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            @endif

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
var ctx = document.getElementById('chartKategori').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($kategori_nama) !!},
        datasets: [{
            label: 'Jumlah Produk',
            data: {!! json_encode($kategori_jumlah) !!},
            backgroundColor: '#424769'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>

@endsection
