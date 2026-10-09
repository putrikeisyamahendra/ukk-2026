@extends('layouts.app')

@section('title', config('app.name') . ' -- Riwayat Peminjaman')

@section('content')

<style>
.alat-page { position: relative; overflow: hidden; }

.alat-header {
    position: relative; min-height: 240px; display: flex; align-items: center;
    overflow: hidden; padding: 2rem; border-radius: 24px;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0,0,0,.08);
    margin-bottom: 1.5rem;
}
.alat-header::before {
    content: ""; position: absolute; width: 420px; height: 420px;
    background: rgba(13,110,253,.08); border-radius: 50%; top: -220px; right: -120px;
}
.alat-header::after {
    content: ""; position: absolute; width: 330px; height: 330px;
    background: rgba(255,193,7,.10); border-radius: 50%; bottom: -190px; left: -100px;
}
.alat-header-content { position: relative; z-index: 2; width: 100%; }

.badge-volley {
    display: inline-block; background: linear-gradient(135deg, #0d6efd, #084298);
    color: #fff; font-weight: 700; box-shadow: 0 6px 18px rgba(13,110,253,.25);
}
.alat-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.text-volley {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.alat-description { color: var(--bs-secondary-color); line-height: 1.8; }
.volley-line {
    width: 65px; height: 4px; margin-bottom: 20px; border-radius: 10px;
    background: linear-gradient(90deg, #0d6efd, #ffc107);
}

.alat-card {
    overflow: hidden; border-radius: 24px; background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color); box-shadow: 0 12px 35px rgba(0,0,0,.07);
}
.alat-card-header {
    display: flex; justify-content: space-between; align-items: center;
    padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--bs-border-color);
    background: linear-gradient(135deg, rgba(13,110,253,.05), rgba(255,193,7,.04));
}
.alat-card-title { color: var(--bs-heading-color); font-weight: 700; }
.alat-card-subtitle { color: var(--bs-secondary-color); font-size: .85rem; }

.table-volley {
    --bs-table-bg: transparent; --bs-table-color: var(--bs-body-color);
    --bs-table-border-color: var(--bs-border-color); margin-bottom: 0;
}
.table-volley thead th {
    padding: 1rem; background: var(--bs-tertiary-bg); color: var(--bs-secondary-color);
    font-size: .78rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: .04em; white-space: nowrap;
}
.table-volley tbody td {
    padding: 1rem; vertical-align: middle; color: var(--bs-body-color);
    border-bottom: 1px solid var(--bs-border-color);
}
.table-volley tbody tr:hover { background: rgba(13,110,253,.035); }
.table-volley tbody tr:last-child td { border-bottom: none; }

.unit-badge {
    display: inline-block; padding: .35rem .65rem; border-radius: 8px;
    background: rgba(13,110,253,.08); border: 1px solid rgba(13,110,253,.12);
    color: #0d6efd; font-size: .8rem; font-weight: 600; white-space: nowrap;
}
.status-badge { display: inline-block; padding: 5px 11px; border-radius: 50px; font-size: .72rem; font-weight: 700; white-space: nowrap; }
.st-pending { background: rgba(255,193,7,.18); color: #b38600; }
.st-setuju  { background: rgba(13,202,240,.18); color: #0a8aa5; }
.st-tolak   { background: rgba(220,53,69,.15); color: #dc3545; }
.st-pinjam  { background: rgba(13,110,253,.15); color: #0d6efd; }
.st-kembali { background: rgba(25,135,84,.15); color: #198754; }

.volleyball {
    position: absolute; width: 105px; height: 105px; border-radius: 50%;
    background: var(--bs-tertiary-bg); border: none;
    box-shadow: 0 12px 28px rgba(0,0,0,.15); z-index: 1; opacity: .95;
}
.volleyball::before {
    content: ""; position: absolute; width: 85px; height: 42px;
    border-top: 6px solid #0d6efd; border-radius: 50%; top: 17px; left: 5px; transform: rotate(35deg);
}
.volleyball::after {
    content: ""; position: absolute; width: 70px; height: 35px;
    border-bottom: 6px solid #ffc107; border-radius: 50%; bottom: 17px; right: 5px; transform: rotate(-35deg);
}
.ball-one { top: 15%; right: 7%; animation: floating 4s ease-in-out infinite; }
.ball-two {
    bottom: 8%; right: 2%; width: 75px; height: 75px; opacity: .65;
    animation: floating 5s ease-in-out infinite reverse;
}
.ball-two::before { width: 60px; height: 30px; border-width: 4px; }
.ball-two::after { width: 50px; height: 25px; border-width: 4px; }

@keyframes floating {
    0%,100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(8deg); }
}

:root:has(#themeToggle:checked) .alat-header { background: linear-gradient(135deg, var(--bs-body-bg), #172033); }
:root:has(#themeToggle:checked) .alat-header::before { background: rgba(13,110,253,.12); }
:root:has(#themeToggle:checked) .alat-header::after { background: rgba(255,193,7,.08); }
:root:has(#themeToggle:checked) .table-volley tbody tr:hover { background: rgba(13,110,253,.07); }

@media (max-width: 768px) {
    .alat-header { min-height: 280px; padding: 1.5rem; }
    .alat-card-header { flex-direction: column; align-items: flex-start; gap: 5px; }
    .volleyball { width: 65px; height: 65px; }
    .volleyball::before { width: 52px; height: 25px; border-width: 4px; }
    .volleyball::after { width: 45px; height: 20px; border-width: 4px; }
    .ball-one { top: 7%; right: 4%; }
    .ball-two { display: none; }
}
</style>

@php
    $data = $data ?? [];
    $namaAlat = [];
    foreach (($alat ?? []) as $a) {
        $namaAlat[$a->id_alat] = $a->nama_alat;
    }
@endphp

<div class="container py-3 py-lg-4 alat-page">

    {{-- HEADER --}}
    <section class="alat-header">

        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>

        <div class="alat-header-content">

            <span class="badge rounded-pill badge-volley px-4 py-2 mb-4">🏐 RIWAYAT SAYA</span>

            <div class="volley-line"></div>

            <h1 class="display-6 fw-bold mb-3 alat-title">
                Riwayat <span class="text-volley">Peminjaman</span>
            </h1>

            <p class="lead alat-description mb-0" style="max-width: 650px;">
                Daftar alat yang pernah kamu pinjam beserta statusnya.
            </p>

        </div>

    </section>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success" style="border-radius: 14px;">✅ {{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" style="border-radius: 14px;">⚠️ {{ session('error') }}</div>
    @endif

    {{-- TABEL --}}
    <div class="alat-card">

        <div class="alat-card-header">
            <div>
                <div class="alat-card-title">📋 Peminjaman Saya</div>
                <div class="alat-card-subtitle">Pantau status pengajuanmu di sini.</div>
            </div>
            <div class="alat-card-subtitle">Total: {{ count($data) }} data</div>
        </div>

        <div class="table-responsive">
            <table class="table table-volley align-middle">

                <thead>
                    <tr>
                        <th>No</th>
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
                            <td class="text-secondary">{{ $no++ }}</td>
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
                                <div class="mb-3" style="font-size: 2.5rem;">🏐</div>
                                <div class="fw-semibold mb-1">Belum ada riwayat</div>
                                <div>Peminjaman yang kamu ajukan akan muncul di sini.</div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection