@extends('member.template')
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

.card-stat {
    border-radius: 14px;
    padding: 22px;
    color: white;
    box-shadow: 0 4px 10px rgba(0,0,0,.12);
}
.stat-title {
    font-size: 14px;
    opacity: 0.85;
    letter-spacing: .3px;
}
.stat-value {
    font-size: 28px;
    font-weight: 700;
}

.card-custom {
    border-radius: 14px;
}

.card-header {
    background: var(--primary) !important;
}

.alert-notif {
    background: var(--edi);
    border: none;
    color: var(--dark);
    font-weight: 600;
}
</style>

<div class="container mt-4">
    <h3 class="fw-bold mb-4" style="color: var(--primary);">Dashboard Member</h3>
    @if(isset($notifikasi) && $notifikasi)
        <div class="alert alert-notif alert-dismissible fade show mt-3" role="alert">
            <strong>Pemberitahuan!</strong><br>
            {{ $notifikasi->pesan }}

            <form action="{{ route('member.notif.clear', $notifikasi->id) }}" method="POST" class="mt-2">
                @csrf
                <button class="btn btn-sm" style="background: var(--primary); color:white; border-radius:6px;">
                    Tandai Sudah Dibaca
                </button>
            </form>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card-stat" style="background: var(--primary);">
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
            <div class="card-stat" style="background: var(--success);">
                <div class="stat-title">Total Produk</div>
                <div class="stat-value">{{ $produk->count() }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-stat" style="background: var(--accent);">
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

    <div class="card card-custom shadow-sm mt-4">
        <div class="card-header text-white">
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
                    <div class="card shadow-sm h-100" style="border-radius: 14px;">
                        <img src="{{ $img ? asset('asset/image/'.$img->nama_gambar) : asset('asset/image/placeholder.png') }}"
                             class="card-img-top"
                             style="height: 180px; object-fit: cover; border-radius: 14px 14px 0 0;">

                        <div class="card-body">
                            <h6 style="color: var(--dark);">{{ $p->nama_produk }}</h6>
                            <strong style="color: var(--primary);">
                                Rp {{ number_format($p->harga, 0, ',', '.') }}
                            </strong>
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
