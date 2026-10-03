@extends('layouts.app')

@section('title', config('app.name') . ' -- Riwayat Peminjaman')

@section('content')

<style>
html:has(.pm-page),
html:has(.pm-page) body { overflow: hidden; }

.pm-page {
    position: fixed; top: 0; right: 0; bottom: 0; left: 260px;
    z-index: 1; overflow-x: hidden; overflow-y: auto;
    scrollbar-width: none;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    color: var(--bs-body-color);
    transition: left .3s ease;
}
.pm-page::-webkit-scrollbar { display: none; }
:root:has(#sidebarToggle:checked) .pm-page { left: 0; }

.pm-content { position: relative; z-index: 2; width: 100%; max-width: 1200px; margin: 0 auto; padding: 80px 24px 40px; }

.badge-volley { background: linear-gradient(135deg, #0d6efd, #084298); color: #fff; font-weight: 600; }
.volley-line { width: 65px; height: 4px; margin: 0 0 16px; border-radius: 10px; background: linear-gradient(90deg, #0d6efd, #ffc107); }
.pm-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.text-volley { background: linear-gradient(90deg, #0d6efd, #084298); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.pm-desc { color: var(--bs-secondary-color); }

.pm-card { overflow: hidden; border-radius: 24px; background: color-mix(in srgb, var(--bs-body-bg) 90%, transparent); border: 1px solid var(--bs-border-color); box-shadow: 0 12px 35px rgba(0,0,0,.08); }
.pm-card-header { display: flex; justify-content: space-between; align-items: center; padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--bs-border-color); }
.pm-card-title { color: var(--bs-heading-color); font-weight: 700; }
.pm-card-sub { color: var(--bs-secondary-color); font-size: .85rem; }

.table-volley { --bs-table-bg: transparent; --bs-table-color: var(--bs-body-color); margin-bottom: 0; }
.table-volley thead th { padding: .9rem 1rem; background: var(--bs-tertiary-bg); color: var(--bs-secondary-color); font-size: .75rem; font-weight: 700; text-transform: uppercase; white-space: nowrap; }
.table-volley tbody td { padding: .9rem 1rem; vertical-align: middle; }

.unit-badge { padding: .3rem .6rem; border-radius: 8px; background: rgba(13,110,253,.08); color: #0d6efd; font-size: .8rem; font-weight: 600; white-space: nowrap; }
.status-badge { display: inline-block; padding: 5px 11px; border-radius: 50px; font-size: .72rem; font-weight: 700; white-space: nowrap; }
.st-pending { background: rgba(255,193,7,.18); color: #b38600; }
.st-setuju  { background: rgba(13,202,240,.18); color: #0a8aa5; }
.st-tolak   { background: rgba(220,53,69,.15); color: #dc3545; }
.st-pinjam  { background: rgba(13,110,253,.15); color: #0d6efd; }
.st-kembali { background: rgba(25,135,84,.15); color: #198754; }

@media (max-width: 991px) { .pm-page, :root:has(#sidebarToggle:checked) .pm-page { left: 0; } }
@media (max-width: 768px) { .pm-content { padding: 80px 15px 30px; } }
</style>

@php
    $data = $data ?? [];
    $namaAlat = [];
    foreach (($alat ?? []) as $a) {
        $namaAlat[$a->id_alat] = $a->nama_alat;
    }
@endphp

<section class="pm-page">
    <div class="pm-content">

        <div class="mb-4">
            <span class="badge rounded-pill badge-volley px-4 py-2 mb-3">🏐 RIWAYAT SAYA</span>
            <div class="volley-line"></div>
            <h1 class="display-6 fw-bold mb-2 pm-title">
                Riwayat <span class="text-volley">Peminjaman</span>
            </h1>
            <p class="pm-desc mb-0">Daftar alat yang pernah kamu pinjam beserta statusnya.</p>
        </div>

        <div class="pm-card">
            <div class="pm-card-header">
                <div>
                    <div class="pm-card-title">📋 Peminjaman Saya</div>
                    <div class="pm-card-sub">Pantau status pengajuanmu di sini.</div>
                </div>
                <span class="pm-card-sub">Total: {{ count($data) }} data</span>
            </div>

            <div class="table-responsive">
                <table class="table table-volley align-middle">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Alat</th>
                            <th>Jumlah</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp

                        @forelse ($data as $peminjaman)
                            <tr>
                                <td class="text-center text-secondary">{{ $no++ }}</td>
                                <td class="fw-semibold">
                                    {{ $namaAlat[$peminjaman->id_alat] ?? 'Alat ID: ' . $peminjaman->id_alat }}
                                </td>
                                <td><span class="unit-badge">{{ $peminjaman->jumlah }} Unit</span></td>
                                <td class="text-secondary">{{ $peminjaman->tanggal_pinjam }}</td>
                                <td class="text-secondary">{{ $peminjaman->tanggal_kembali ?: '-' }}</td>
                                <td>
                                    @if ($peminjaman->status == 'Pending')
                                        <span class="status-badge st-pending">⏳ Pending</span>
                                    @elseif ($peminjaman->status == 'Disetujui')
                                        <span class="status-badge st-setuju">✔ Disetujui</span>
                                    @elseif ($peminjaman->status == 'Ditolak')
                                        <span class="status-badge st-tolak">✖ Ditolak</span>
                                    @elseif ($peminjaman->status == 'Dipinjam')
                                        <span class="status-badge st-pinjam">📦 Dipinjam</span>
                                    @else
                                        <span class="status-badge st-kembali">✅ Dikembalikan</span>
                                    @endif
                                </td>
                                <td>
                                    @if (($peminjaman->denda ?? 0) > 0)
                                        <span class="text-danger fw-bold">Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-secondary">Rp 0</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-secondary">
                                    <div style="font-size: 2.5rem;">🏐</div>
                                    <div class="fw-bold mb-1">Belum Ada Riwayat</div>
                                    <div class="small">Peminjaman yang kamu ajukan akan muncul di sini.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

@endsection