@extends('member.template')
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

<div class="container mt-4">

    <h3 class="fw-bold mb-4">Dashboard Member</h3>

    {{-- =============================
        1. NOTIFIKASI PENTING
    ============================= --}}
    @if(isset($notifikasi) && $notifikasi)
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <strong>Pemberitahuan!</strong><br>
            {{ $notifikasi->pesan }}

            <form action="{{ route('member.notif.clear', $notifikasi->id) }}" method="POST" class="mt-2">
                @csrf
                <button class="btn btn-sm btn-outline-light">Tandai Sudah Dibaca</button>
            </form>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- =============================
        2. INFORMASI TOKO
    ============================= --}}
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card-stat bg-primary shadow-sm">
                <div class="stat-title">Status Toko</div>
                <div class="stat-value">
                    @if ($toko)
                        {{ ucfirst($toko->status) }}
                    @else
                        Belum Ada
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-stat bg-success shadow-sm">
                <div class="stat-title">Total Produk</div>
                <div class="stat-value">{{ $produk->count() }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-stat bg-warning shadow-sm">
                <div class="stat-title">Toko Dibuat</div>
                <div class="stat-value">
                    @if($toko)
                        {{ $toko->created_at->format('d M Y') }}
                    @else
                        -
                    @endif
                </div>
            </div>
        </div>

    </div>


    {{-- =============================
        3. PRODUK TERBARU
    ============================= --}}
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 fw-bold">Produk Terbaru Anda</h5>
        </div>
        <div class="card-body">

            @if($produk->count() == 0)
                <p class="text-center text-muted">Anda belum memiliki produk.</p>
            @else

            <div class="row g-3">
                @foreach($produk->take(4) as $p)
                @php $img = $p->gambar->first(); @endphp

                <div class="col-md-3">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $img ? asset('asset/image/'.$img->nama_gambar) : asset('asset/image/placeholder.png') }}"
                             class="card-img-top"
                             style="height: 180px; object-fit: cover; border-radius: 8px 8px 0 0;">

                        <div class="card-body">
                            <h6>{{ $p->nama_produk }}</h6>
                            <strong>Rp {{ number_format($p->harga, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>

            @endif

        </div>
    </div>

</div>

@endsection
