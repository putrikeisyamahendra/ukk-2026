@extends('layouts.app')

@section('title', config('app.name') . ' -- Pengembalian Alat')

@section('content')

<style>
html:has(.pm-page), html:has(.pm-page) body { overflow: hidden; }
.pm-page { position: fixed; top: 0; right: 0; bottom: 0; left: 260px; z-index: 1; overflow-y: auto; scrollbar-width: none; background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg)); color: var(--bs-body-color); transition: left .3s ease; }
.pm-page::-webkit-scrollbar { display: none; }
:root:has(#sidebarToggle:checked) .pm-page { left: 0; }
.pm-content { width: 100%; max-width: 1200px; margin: 0 auto; padding: 80px 24px 40px; }
.pm-card { overflow: hidden; border-radius: 24px; background: color-mix(in srgb, var(--bs-body-bg) 90%, transparent); border: 1px solid var(--bs-border-color); box-shadow: 0 12px 35px rgba(0,0,0,.08); }
.table-volley { --bs-table-bg: transparent; margin-bottom: 0; }
.table-volley thead th { padding: .9rem 1rem; background: var(--bs-tertiary-bg); color: var(--bs-secondary-color); font-size: .75rem; text-transform: uppercase; white-space: nowrap; }
.table-volley tbody td { padding: .9rem 1rem; vertical-align: middle; }
.status-badge { display: inline-block; padding: 5px 11px; border-radius: 50px; font-size: .72rem; font-weight: 700; }
.st-setuju  { background: rgba(13,202,240,.18); color: #0a8aa5; }
.st-kembali { background: rgba(25,135,84,.15); color: #198754; }
@media (max-width: 991px) { .pm-page, :root:has(#sidebarToggle:checked) .pm-page { left: 0; } }
@media (max-width: 768px) { .pm-content { padding: 80px 15px 30px; } }
</style>

@php
    $namaAlat = [];
    foreach ($alat as $a) {
        $namaAlat[$a->id_alat] = $a->nama_alat;
    }
@endphp

<section class="pm-page">
    <div class="pm-content">

        <h1 class="display-6 fw-bold mb-2">Pengembalian Alat</h1>
        <p class="text-secondary mb-4">Lihat batas pengembalian alat yang kamu pinjam. Telat mengembalikan akan dikenai denda Rp5.000 per hari.</p>

        <div class="pm-card">
            <div class="table-responsive">
                <table class="table table-volley align-middle">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Alat</th>
                            <th>Jumlah</th>
                            <th>Batas Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($data as $p)
                            <tr>
                                <td class="text-center text-secondary">{{ $no++ }}</td>
                                <td class="fw-semibold">{{ $namaAlat[$p->id_alat] ?? 'Alat ID: ' . $p->id_alat }}</td>
                                <td>{{ $p->jumlah }} Unit</td>
                                <td>{{ $p->tanggal_kembali ?: '-' }}</td>
                                <td>
                                    @if ($p->status == 'Disetujui')
                                        <span class="status-badge st-setuju">📦 Belum dikembalikan</span>
                                    @else
                                        <span class="status-badge st-kembali">✅ Dikembalikan</span>
                                    @endif
                                </td>
                                <td>
                                    @if (($p->denda ?? 0) > 0)
                                        <span class="text-danger fw-bold">Rp {{ number_format($p->denda, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-secondary">Rp 0</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-secondary">
                                    <div style="font-size: 2.5rem;">🏐</div>
                                    <div class="fw-bold">Belum ada alat yang dipinjam</div>
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