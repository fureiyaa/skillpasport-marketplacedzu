@extends('admin.template')
@section('content')

<style>
    .card-stat {
        border-radius: 12px;
        padding: 20px;
        color: white;
    }
    .stat-title {
        font-size: 14px;
        opacity: 0.9;
    }
    .stat-value {
        font-size: 28px;
        font-weight: 700;
    }
</style>

<div class="container mt-3">

    <h3 class="fw-bold mb-4">Dashboard Admin</h3>

    {{-- ========= STATISTIK ========= --}}
    <div class="row g-4">

        <div class="col-md-3">
            <div class="card-stat bg-primary shadow-sm">
                <div class="stat-title">Total User</div>
                <div class="stat-value">{{ $total_user }}</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-stat bg-success shadow-sm">
                <div class="stat-title">Total Toko</div>
                <div class="stat-value">{{ $total_toko }}</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-stat bg-warning shadow-sm">
                <div class="stat-title">Pengajuan Pending</div>
                <div class="stat-value text-dark">{{ $pending_toko }}</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-stat bg-danger shadow-sm">
                <div class="stat-title">Total Produk</div>
                <div class="stat-value">{{ $total_produk }}</div>
            </div>
        </div>

    </div>

    {{-- ========= GRAFIK ========= --}}
    <div class="card shadow-sm mt-4 p-4">
        <h5 class="fw-bold mb-3">Grafik Produk per Kategori</h5>
        <canvas id="chartKategori" height="120"></canvas>
    </div>

    {{-- ========= PENGAJUAN PENDING ========= --}}
    <div class="card shadow-sm mt-4 mb-5">
        <div class="card-header bg-primary text-white fw-bold">
            Pengajuan Toko Pending
        </div>
        <div class="card-body">

            @if($pending_list->count() == 0)
                <p class="text-muted text-center">Tidak ada pengajuan toko yang pending.</p>
            @else
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
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


{{-- ========= SCRIPT GRAFIK ========= --}}
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
                backgroundColor: '#1d4ed8'
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
