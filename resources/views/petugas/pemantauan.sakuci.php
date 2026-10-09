@extends('layouts.app')

@section('title', 'Pemantauan Pengembalian')

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
.pn-ok     { background: rgba(13,110,253,.15); color: #0d6efd; }
.pn-late   { background: rgba(220,53,69,.15); color: #dc3545; }
.pn-baik   { background: rgba(25,135,84,.15); color: #198754; }
.pn-rusak  { background: rgba(255,193,7,.2); color: #b38600; }
.pn-hilang { background: rgba(220,53,69,.15); color: #dc3545; }

.btn-volley {
    border: none; border-radius: 9px; font-weight: 700; color: #fff;
    background: linear-gradient(135deg, #0d6efd, #084298);
}
.btn-volley:hover { color: #fff; }

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
    $namaUser = [];
    foreach ($users as $u) { $namaUser[$u->id] = $u->username; }

    $namaAlat = [];
    foreach ($alat as $a) { $namaAlat[$a->id_alat] = $a->nama_alat; }

    $petaPinjam = [];
    foreach ($peminjaman as $pm) { $petaPinjam[$pm->id_peminjaman] = $pm; }

    $hariIni = strtotime(date('Y-m-d'));
@endphp

<div class="container py-3 py-lg-4 alat-page">

    {{-- HEADER --}}
    <section class="alat-header">

        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>

        <div class="alat-header-content">
            <span class="badge rounded-pill badge-volley px-4 py-2 mb-4">🏐 PEMANTAUAN</span>
            <div class="volley-line"></div>
            <h1 class="display-6 fw-bold mb-3 alat-title">
                Pemantauan <span class="text-volley">Pengembalian</span>
            </h1>
            <p class="lead alat-description mb-0" style="max-width: 650px;">
                Pantau alat yang masih dipinjam, cek keterlambatan,
                dan perbarui kondisi alat yang sudah kembali.
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

    {{-- MASIH DIPINJAM --}}
    <div class="alat-card mb-4">

        <div class="alat-card-header">
            <div>
                <div class="alat-card-title">📦 Masih Dipinjam</div>
                <div class="alat-card-subtitle">Alat yang belum dikembalikan peminjam.</div>
            </div>
            <div class="alat-card-subtitle">Total: {{ count($dipinjam) }} data</div>
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
                        <th>Batas Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp

                    @forelse ($dipinjam as $p)
                        @php
                            $batas = $p->tanggal_kembali ? strtotime($p->tanggal_kembali) : 0;
                            $telat = $batas && $hariIni > $batas;
                            $hari  = $telat ? (int) floor(($hariIni - $batas) / 86400) : 0;
                        @endphp
                        <tr>
                            <td class="text-secondary">{{ $no++ }}</td>
                            <td class="fw-semibold">{{ $namaUser[$p->id_user] ?? 'User ' . $p->id_user }}</td>
                            <td class="fw-semibold">{{ $namaAlat[$p->id_alat] ?? 'Alat ' . $p->id_alat }}</td>
                            <td><span class="unit-badge">{{ $p->jumlah }} Unit</span></td>
                            <td class="text-secondary">{{ $p->tanggal_pinjam }}</td>
                            <td class="text-secondary">{{ $p->tanggal_kembali ?: '-' }}</td>
                            <td>
                                @if ($telat)
                                    <span class="status-badge pn-late">⚠ Terlambat {{ $hari }} hari</span>
                                @else
                                    <span class="status-badge pn-ok">📦 Dipinjam</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-secondary">
                                <div class="mb-3" style="font-size: 2.5rem;">🏐</div>
                                <div class="fw-semibold mb-1">Tidak ada alat yang sedang dipinjam</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    {{-- SUDAH DIKEMBALIKAN --}}
    <div class="alat-card">

        <div class="alat-card-header">
            <div>
                <div class="alat-card-title">✅ Sudah Dikembalikan</div>
                <div class="alat-card-subtitle">Riwayat pengembalian beserta denda dan kondisi alat.</div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-volley align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Tgl Kembali</th>
                        <th>Terlambat</th>
                        <th>Denda</th>
                        <th>Kondisi</th>
                        <th>Ubah Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no2 = 1; @endphp

                    @forelse ($kembali as $k)
                        @php $pm = $petaPinjam[$k->id_peminjaman] ?? null; @endphp
                        <tr>
                            <td class="text-secondary">{{ $no2++ }}</td>
                            <td class="fw-semibold">{{ $pm ? ($namaUser[$pm->id_user] ?? 'User ' . $pm->id_user) : '-' }}</td>
                            <td class="fw-semibold">{{ $pm ? ($namaAlat[$pm->id_alat] ?? 'Alat ' . $pm->id_alat) : '-' }}</td>
                            <td class="text-secondary">{{ $k->tanggal_pengembalian }}</td>
                            <td>{{ (int) $k->terlambat_hari }} hari</td>
                            <td>
                                @if ((int) $k->denda > 0)
                                    <span class="text-danger fw-bold">Rp {{ number_format($k->denda, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-secondary">Rp 0</span>
                                @endif
                            </td>
                            <td>
                                @if ($k->kondisi_barang === 'Rusak')
                                    <span class="status-badge pn-rusak">Rusak</span>
                                @elseif ($k->kondisi_barang === 'Hilang')
                                    <span class="status-badge pn-hilang">Hilang</span>
                                @else
                                    <span class="status-badge pn-baik">Baik</span>
                                @endif
                            </td>
                            <td>
                                <form method="POST"
                                      action="{{ route('petugas.kondisi', ['id_pengembalian' => $k->id_pengembalian]) }}"
                                      class="d-flex gap-1 mb-0">
                                    @csrf
                                    @method('PUT')
                                    <select name="kondisi_barang" class="form-select form-select-sm" style="min-width: 90px;">
                                        @foreach (['Baik', 'Rusak', 'Hilang'] as $opsi)
                                            <option value="{{ $opsi }}" {{ $k->kondisi_barang === $opsi ? 'selected' : '' }}>{{ $opsi }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-volley">Simpan</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-secondary">
                                <div class="mb-3" style="font-size: 2.5rem;">🏐</div>
                                <div class="fw-semibold mb-1">Belum ada pengembalian</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    @if (method_exists($kembali, 'hasPages') && $kembali->hasPages())
        <div class="mt-4">{!! $kembali->links() !!}</div>
    @endif

</div>

@endsection