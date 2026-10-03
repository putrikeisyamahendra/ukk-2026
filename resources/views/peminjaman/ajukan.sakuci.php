@extends('layouts.app')

@section('title', config('app.name') . ' -- Ajukan Peminjaman')

@section('content')

<style>
html:has(.pm-page), html:has(.pm-page) body { overflow: hidden; }
.pm-page { position: fixed; top: 0; right: 0; bottom: 0; left: 260px; z-index: 1; overflow-x: hidden; overflow-y: auto; scrollbar-width: none; background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg)); color: var(--bs-body-color); transition: left .3s ease; }
.pm-page::-webkit-scrollbar { display: none; }
:root:has(#sidebarToggle:checked) .pm-page { left: 0; }
.pm-content { position: relative; z-index: 2; width: 100%; max-width: 640px; margin: 0 auto; padding: 80px 24px 40px; }
.badge-volley { background: linear-gradient(135deg, #0d6efd, #084298); color: #fff; font-weight: 600; }
.volley-line { width: 65px; height: 4px; margin: 0 0 16px; border-radius: 10px; background: linear-gradient(90deg, #0d6efd, #ffc107); }
.text-volley { background: linear-gradient(90deg, #0d6efd, #084298); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.pm-card { border-radius: 24px; padding: 1.8rem; background: var(--bs-body-bg); border: 1px solid var(--bs-border-color); box-shadow: 0 12px 35px rgba(0,0,0,.08); }
.btn-volley { border: none; border-radius: 12px; font-weight: 700; color: #fff; background: linear-gradient(135deg, #0d6efd, #084298); box-shadow: 0 7px 18px rgba(13,110,253,.22); }
.btn-volley:hover { color: #fff; }
@media (max-width: 991px) { .pm-page, :root:has(#sidebarToggle:checked) .pm-page { left: 0; } }
@media (max-width: 768px) { .pm-content { padding: 80px 15px 30px; } }
</style>

<section class="pm-page">
    <div class="pm-content">

        <span class="badge rounded-pill badge-volley px-4 py-2 mb-3">🏐 PENGAJUAN</span>
        <div class="volley-line"></div>
        <h1 class="display-6 fw-bold mb-4">Ajukan <span class="text-volley">Peminjaman</span></h1>

        @if (session('error'))
            <div class="alert alert-danger">⚠️ {{ session('error') }}</div>
        @endif

        <div class="pm-card">
            <form method="POST" action="{{ route('peminjam.kirim') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold" for="id_alat">Pilih Alat</label>
                    <select id="id_alat" name="id_alat" class="form-select" required>
                        <option value="">-- Pilih Alat --</option>
                        @foreach ($alat as $item)
                            <option value="{{ $item->id_alat }}">{{ $item->nama_alat }} (stok: {{ (int) $item->stok }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" for="jumlah">Jumlah Unit</label>
                    <input type="number" id="jumlah" name="jumlah" class="form-control" min="1" value="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" for="tanggal_pinjam">Tanggal Pinjam</label>
                    <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold" for="tanggal_kembali">Rencana Tanggal Kembali</label>
                    <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-volley btn-lg w-100">Ajukan Peminjaman</button>
            </form>
        </div>

    </div>
</section>

@endsection