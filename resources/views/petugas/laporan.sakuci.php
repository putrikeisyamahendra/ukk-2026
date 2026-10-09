@extends('layouts.app')

@section('title', 'Laporan Peminjaman')

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

.btn-volley {
    border: none; border-radius: 12px; font-weight: 700; color: #fff;
    background: linear-gradient(135deg, #0d6efd, #084298);
    box-shadow: 0 7px 18px rgba(13,110,253,.22); transition: all .3s ease;
}
.btn-volley:hover { color: #fff; transform: translateY(-3px); box-shadow: 0 11px 25px rgba(13,110,253,.32); }

.alat-search {
    padding: 18px 22px; margin-bottom: 1.5rem; border-radius: 20px;
    background: var(--bs-body-bg); border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0,0,0,.06);
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
    padding: .9rem 1rem; vertical-align: middle; color: var(--bs-body-color);
    border-bottom: 1px solid var(--bs-border-color);
}
.table-volley tbody tr:hover { background: rgba(13,110,253,.035); }
.table-volley tfoot th { padding: 1rem; background: var(--bs-tertiary-bg); }

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

.lp-print-head { display: none; }

:root:has(#themeToggle:checked) .alat-header { background: linear-gradient(135deg, var(--bs-body-bg), #172033); }
:root:has(#themeToggle:checked) .alat-header::before { background: rgba(13,110,253,.12); }
:root:has(#themeToggle:checked) .alat-header::after { background: rgba(255,193,7,.08); }

@media (max-width: 768px) {
    .alat-header { min-height: 280px; padding: 1.5rem; }
    .alat-header .btn-volley { width: 100%; }
    .volleyball { width: 65px; height: 65px; }
    .volleyball::before { width: 52px; height: 25px; border-width: 4px; }
    .volleyball::after { width: 45px; height: 20px; border-width: 4px; }
    .ball-one { top: 7%; right: 4%; }
    .ball-two { display: none; }
}

/* ===== TAMPILAN CETAK ===== */
@media print {
    html, body { overflow: visible !important; background: #fff !important; }

    .sidebar, .sidebar-button, .theme-button, .sidebar-toggle, .theme-checkbox,
    .no-print { display: none !important; }

    .alat-page { overflow: visible !important; padding: 0 !important; max-width: 100% !important; }

    .alat-card { border: none; box-shadow: none; background: #fff; border-radius: 0; }
    .alat-card-header { display: none; }

    .table-volley, .table-volley td, .table-volley th {
        color: #000 !important;
        border: 1px solid #999 !important;
        background: #fff !important;
    }

    .lp-print-head { display: block; text-align: center; margin-bottom: 16px; color: #000; }
}
</style>

@php
    $namaUser = [];
    foreach ($users as $u) { $namaUser[$u->id] = $u->username; }

    $namaAlat = [];
    foreach ($alat as $a) { $namaAlat[$a->id_alat] = $a->nama_alat; }

    $totalDenda = 0;
    foreach ($data as $d) { $totalDenda += (int) ($d->denda ?? 0); }

    $daftarStatus = ['Pending', 'Disetujui', 'Ditolak', 'Dikembalikan'];
@endphp

<div class="container py-3 py-lg-4 alat-page">

    {{-- Kop khusus cetak --}}
    <div class="lp-print-head">
        <h2 style="margin:0;">LAPORAN PEMINJAMAN ALAT OLAHRAGA VOLI</h2>
        <div>
            Periode: {{ request('dari') ?: 'awal' }} s/d {{ request('sampai') ?: 'sekarang' }}
            @if (request('status')) | Status: {{ request('status') }} @endif
        </div>
        <div>Dicetak: {{ date('d-m-Y H:i') }}</div>
    </div>

    {{-- HEADER --}}
    <section class="alat-header no-print">

        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>

        <div class="alat-header-content">

            <span class="badge rounded-pill badge-volley px-4 py-2 mb-4">🏐 LAPORAN</span>

            <div class="volley-line"></div>

            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-3 alat-title">
                        Laporan <span class="text-volley">Peminjaman</span>
                    </h1>
                    <p class="lead alat-description mb-0" style="max-width: 650px;">
                        Filter data peminjaman berdasarkan tanggal dan status,
                        lalu cetak sebagai laporan.
                    </p>
                </div>

                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <button type="button" onclick="window.print()" class="btn btn-volley btn-lg px-4">
                        🖨️ Cetak Laporan
                    </button>
                </div>
            </div>

        </div>

    </section>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('petugas.laporan') }}" class="alat-search no-print">
        <div class="row g-3 align-items-end">

            <div class="col-md-3">
                <label class="form-label small mb-1">Dari tanggal</label>
                <input type="date" name="dari" value="{{ request('dari') }}" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label small mb-1">Sampai tanggal</label>
                <input type="date" name="sampai" value="{{ request('sampai') }}" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label small mb-1">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua</option>
                    @foreach ($daftarStatus as $s)
                        <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-volley flex-fill">🔍 Terapkan</button>
                <a href="{{ route('petugas.laporan') }}" class="btn btn-outline-secondary">Reset</a>
            </div>

        </div>
    </form>

    {{-- TABEL --}}
    <div class="alat-card">

        <div class="alat-card-header">
            <div>
                <div class="alat-card-title">📋 Data Peminjaman</div>
                <div class="alat-card-subtitle">Hasil sesuai filter yang dipilih.</div>
            </div>
            <div class="alat-card-subtitle">Total: {{ count($data) }} data</div>
        </div>

        <div class="table-responsive">
            <table class="table table-volley align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Jumlah</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>

                <tbody>
                    @php $no = 1; @endphp

                    @forelse ($data as $p)
                        <tr>
                            <td class="text-secondary">{{ $no++ }}</td>
                            <td class="fw-semibold">{{ $namaUser[$p->id_user] ?? 'User ' . $p->id_user }}</td>
                            <td>{{ $namaAlat[$p->id_alat] ?? 'Alat ' . $p->id_alat }}</td>
                            <td>{{ $p->jumlah }}</td>
                            <td>{{ $p->tanggal_pinjam }}</td>
                            <td>{{ $p->tanggal_kembali ?: '-' }}</td>
                            <td>{{ $p->status }}</td>
                            <td>Rp {{ number_format((int) ($p->denda ?? 0), 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-secondary">
                                <div class="mb-3 no-print" style="font-size: 2.5rem;">🏐</div>
                                <div class="fw-semibold mb-1">Tidak ada data</div>
                                <div>Tidak ada data untuk filter ini.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

                @if (count($data) > 0)
                    <tfoot>
                        <tr>
                            <th colspan="7" class="text-end">Total data: {{ count($data) }} | Total denda</th>
                            <th>Rp {{ number_format($totalDenda, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                @endif

            </table>
        </div>

    </div>

</div>

@endsection