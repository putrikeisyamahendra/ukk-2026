@extends('layouts.app')

@section('title', 'Pemantauan Pengembalian')

@section('content')

<style>
html:has(.pn-page), html:has(.pn-page) body { overflow: hidden; }

.pn-page {
    position: fixed; top: 0; right: 0; bottom: 0; left: 260px; z-index: 1;
    overflow-y: auto; scrollbar-width: none;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    color: var(--bs-body-color);
    transition: left .3s ease;
}
.pn-page::-webkit-scrollbar { display: none; }
:root:has(#sidebarToggle:checked) .pn-page { left: 0; }

.pn-content { max-width: 1100px; margin: 0 auto; padding: 80px 24px 40px; }
.pn-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.pn-title span {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.pn-card {
    overflow: hidden; border-radius: 20px;
    background: color-mix(in srgb, var(--bs-body-bg) 90%, transparent);
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0,0,0,.08);
}
.pn-card-head {
    padding: 1rem 1.5rem; font-weight: 700; color: var(--bs-heading-color);
    border-bottom: 1px solid var(--bs-border-color);
    background: linear-gradient(135deg, rgba(13,110,253,.05), rgba(255,193,7,.04));
}
.pn-table {
    --bs-table-bg: transparent;
    --bs-table-color: var(--bs-body-color);
    --bs-table-border-color: var(--bs-border-color);
    margin: 0;
}
.pn-table thead th {
    background: var(--bs-tertiary-bg); color: var(--bs-secondary-color);
    font-size: .75rem; text-transform: uppercase; letter-spacing: .04em;
    padding: .9rem 1rem; white-space: nowrap;
}
.pn-table td { padding: .9rem 1rem; vertical-align: middle; }
.pn-badge { padding: 4px 11px; border-radius: 50px; font-size: .72rem; font-weight: 700; white-space: nowrap; }
.pn-ok    { background: rgba(13,110,253,.15); color: #0d6efd; }
.pn-late  { background: rgba(220,53,69,.15); color: #dc3545; }
.pn-baik  { background: rgba(25,135,84,.15); color: #198754; }
.pn-rusak { background: rgba(255,193,7,.2); color: #b38600; }
.pn-hilang{ background: rgba(220,53,69,.15); color: #dc3545; }

@media (max-width: 991px) { .pn-page, :root:has(#sidebarToggle:checked) .pn-page { left: 0; } }
@media (max-width: 768px) { .pn-content { padding: 80px 15px 30px; } }
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

<section class="pn-page">
    <div class="pn-content">

        <h1 class="display-6 fw-bold mb-1 pn-title">
            Pemantauan <span>Pengembalian</span>
        </h1>
        <p class="text-secondary mb-4">Pantau alat yang masih dipinjam dan yang sudah dikembalikan.</p>

        @if (session('success'))
            <div class="alert alert-success" style="border-radius: 14px;">✅ {{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" style="border-radius: 14px;">⚠️ {{ session('error') }}</div>
        @endif


        {{-- MASIH DIPINJAM --}}

        <div class="pn-card mb-4">
            <div class="pn-card-head">📦 Masih Dipinjam ({{ count($dipinjam) }})</div>

            <div class="table-responsive">
                <table class="table pn-table">
                    <thead>
                        <tr>
                            <th>Peminjam</th>
                            <th>Alat</th>
                            <th>Jumlah</th>
                            <th>Tgl Pinjam</th>
                            <th>Batas Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dipinjam as $p)
                            @php
                                $batas = $p->tanggal_kembali ? strtotime($p->tanggal_kembali) : 0;
                                $telat = $batas && $hariIni > $batas;
                                $hari  = $telat ? (int) floor(($hariIni - $batas) / 86400) : 0;
                            @endphp
                            <tr>
                                <td class="fw-semibold">{{ $namaUser[$p->id_user] ?? 'User ' . $p->id_user }}</td>
                                <td>{{ $namaAlat[$p->id_alat] ?? 'Alat ' . $p->id_alat }}</td>
                                <td>{{ $p->jumlah }} Unit</td>
                                <td class="text-secondary">{{ $p->tanggal_pinjam }}</td>
                                <td class="text-secondary">{{ $p->tanggal_kembali ?: '-' }}</td>
                                <td>
                                    @if ($telat)
                                        <span class="pn-badge pn-late">⚠ Terlambat {{ $hari }} hari</span>
                                    @else
                                        <span class="pn-badge pn-ok">📦 Dipinjam</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-secondary">
                                    Tidak ada alat yang sedang dipinjam.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


        {{-- SUDAH DIKEMBALIKAN --}}

        <div class="pn-card">
            <div class="pn-card-head">✅ Sudah Dikembalikan</div>

            <div class="table-responsive">
                <table class="table pn-table">
                    <thead>
                        <tr>
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
                        @forelse ($kembali as $k)
                            @php $pm = $petaPinjam[$k->id_peminjaman] ?? null; @endphp
                            <tr>
                                <td class="fw-semibold">
                                    {{ $pm ? ($namaUser[$pm->id_user] ?? 'User ' . $pm->id_user) : '-' }}
                                </td>
                                <td>
                                    {{ $pm ? ($namaAlat[$pm->id_alat] ?? 'Alat ' . $pm->id_alat) : '-' }}
                                </td>
                                <td class="text-secondary">{{ $k->tanggal_pengembalian }}</td>
                                <td>{{ (int) $k->terlambat_hari }} hari</td>
                                <td>
                                    @if ((int) $k->denda > 0)
                                        <span class="text-danger fw-bold">
                                            Rp {{ number_format($k->denda, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-secondary">Rp 0</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($k->kondisi_barang === 'Rusak')
                                        <span class="pn-badge pn-rusak">Rusak</span>
                                    @elseif ($k->kondisi_barang === 'Hilang')
                                        <span class="pn-badge pn-hilang">Hilang</span>
                                    @else
                                        <span class="pn-badge pn-baik">Baik</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST"
                                          action="{{ route('petugas.kondisi', ['id_pengembalian' => $k->id_pengembalian]) }}"
                                          class="d-flex gap-1">
                                        @csrf
                                        @method('PUT')
                                        <select name="kondisi_barang" class="form-select form-select-sm" style="min-width: 90px;">
                                            @foreach (['Baik', 'Rusak', 'Hilang'] as $opsi)
                                                <option value="{{ $opsi }}" {{ $k->kondisi_barang === $opsi ? 'selected' : '' }}>
                                                    {{ $opsi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-sm btn-primary">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-secondary">
                                    Belum ada pengembalian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($kembali, 'hasPages') && $kembali->hasPages())
                <div class="p-3 d-flex justify-content-end">{!! $kembali->links() !!}</div>
            @endif
        </div>

    </div>
</section>

@endsection