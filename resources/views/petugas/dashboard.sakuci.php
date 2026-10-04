@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@section('content')

<style>
html:has(.pt-page), html:has(.pt-page) body { overflow: hidden; }

.pt-page {
    position: fixed; top: 0; right: 0; bottom: 0; left: 260px; z-index: 1;
    display: flex; overflow-y: auto; scrollbar-width: none;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    color: var(--bs-body-color);
    transition: left .3s ease;
}
.pt-page::-webkit-scrollbar { display: none; }
:root:has(#sidebarToggle:checked) .pt-page { left: 0; }

.pt-content { width: 100%; max-width: 800px; margin: auto; padding: 80px 20px 40px; text-align: center; }
.pt-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.pt-title span {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.pt-card {
    padding: 20px; border-radius: 16px;
    background: var(--bs-body-bg); border: 1px solid var(--bs-border-color);
    box-shadow: 0 6px 18px rgba(0,0,0,.06);
}
.pt-card small { display: block; color: var(--bs-secondary-color); font-weight: 700; letter-spacing: 1px; text-transform: uppercase; font-size: 12px; }
.pt-card strong { color: #0d6efd; font-size: 28px; }
.btn-volley {
    border: none; border-radius: 12px; font-weight: 700; color: #fff;
    background: linear-gradient(135deg, #0d6efd, #084298);
}
.btn-volley:hover { color: #fff; }

@media (max-width: 991px) { .pt-page, :root:has(#sidebarToggle:checked) .pt-page { left: 0; } }
</style>

<section class="pt-page">
    <div class="pt-content">

        <span class="badge rounded-pill px-4 py-2 mb-4 text-white"
              style="background: linear-gradient(135deg, #0d6efd, #084298);">
            🏐 ROLE: PETUGAS
        </span>

        <h1 class="display-5 fw-bold mb-3 pt-title">
            Halo, <span>{{ $user->username }}</span>
        </h1>

        <p class="text-secondary mb-4">
            Pantau dan proses pengajuan peminjaman alat.
        </p>

        <div class="row g-3 mb-4">
            <div class="col-sm-4"><div class="pt-card"><small>Menunggu</small><strong>{{ $menunggu }}</strong></div></div>
            <div class="col-sm-4"><div class="pt-card"><small>Dipinjam</small><strong>{{ $dipinjam }}</strong></div></div>
            <div class="col-sm-4"><div class="pt-card"><small>Selesai</small><strong>{{ $selesai }}</strong></div></div>
        </div>

        <a href="{{ route('petugas.persetujuan') }}" class="btn btn-volley btn-lg px-4">
            Lihat Pengajuan
        </a>

    </div>
</section>

@endsection