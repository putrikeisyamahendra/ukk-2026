@extends('layouts.app')

@section('title', 'Log Aktivitas')

@section('content')

<style>
html:has(.lg-page), html:has(.lg-page) body { overflow: hidden; }

.lg-page {
    position: fixed; top: 0; right: 0; bottom: 0; left: 260px; z-index: 1;
    overflow-x: hidden; overflow-y: auto; scrollbar-width: none;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    color: var(--bs-body-color);
    transition: left .3s ease;
}
.lg-page::-webkit-scrollbar { display: none; }
:root:has(#sidebarToggle:checked) .lg-page { left: 0; }

.lg-page::before {
    content: ""; position: fixed; width: 420px; height: 420px;
    background: rgba(13,110,253,.08); border-radius: 50%;
    top: -180px; left: -130px; pointer-events: none;
}
.lg-page::after {
    content: ""; position: fixed; width: 330px; height: 330px;
    background: rgba(255,193,7,.10); border-radius: 50%;
    bottom: -160px; right: -100px; pointer-events: none;
}

.lg-content { position: relative; z-index: 2; max-width: 1100px; margin: 0 auto; padding: 80px 24px 40px; }

/* CARD HEADER */
.lg-head-card {
    padding: 28px 30px; margin-bottom: 20px; border-radius: 24px;
    background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0,0,0,.08);
    position: relative; overflow: hidden;
}
.lg-head-card::after {
    content: ""; position: absolute; width: 260px; height: 260px; border-radius: 50%;
    background: rgba(255,193,7,.10); top: -130px; right: -80px; pointer-events: none;
}
.lg-head-inner { position: relative; z-index: 2; }

.badge-volley {
    background: linear-gradient(135deg, #0d6efd, #084298); color: #fff;
    font-weight: 600; box-shadow: 0 6px 18px rgba(13,110,253,.25);
}
.volley-line {
    width: 65px; height: 4px; margin: 0 0 16px; border-radius: 10px;
    background: linear-gradient(90deg, #0d6efd, #ffc107);
}
.lg-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.lg-title span {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}

/* Kartu ringkasan */
.lg-stat {
    padding: 18px 20px; border-radius: 18px;
    background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 8px 24px rgba(0,0,0,.06);
    display: flex; align-items: center; gap: 14px;
}
.lg-stat-icon {
    width: 46px; height: 46px; border-radius: 14px; display: flex;
    align-items: center; justify-content: center; font-size: 22px; color: #fff;
    background: linear-gradient(135deg, #0d6efd, #084298);
    box-shadow: 0 6px 15px rgba(13,110,253,.2);
}
.lg-stat-icon.kuning { background: linear-gradient(135deg, #ffc107, #ffda44); }
.lg-stat small { display: block; color: var(--bs-secondary-color); font-weight: 700; letter-spacing: 1px; text-transform: uppercase; font-size: 11px; }
.lg-stat strong { color: var(--bs-heading-color); font-size: 24px; line-height: 1.1; }

/* Pencarian */
.lg-search { display: flex; gap: 8px; width: 100%; max-width: 340px; }
.lg-search input {
    flex: 1; min-width: 0; height: 44px; padding: 0 14px; border-radius: 12px;
    border: 1px solid var(--bs-border-color); background: var(--bs-body-bg);
    color: var(--bs-body-color); outline: none;
}
.lg-search input:focus { border-color: #0d6efd; box-shadow: 0 0 0 3px rgba(13,110,253,.12); }
.btn-volley {
    border: none; border-radius: 12px; font-weight: 700; color: #fff;
    background: linear-gradient(135deg, #0d6efd, #084298);
    box-shadow: 0 7px 18px rgba(13,110,253,.22); transition: all .3s ease;
}
.btn-volley:hover { color: #fff; transform: translateY(-2px); }

/* Tabel */
.lg-card {
    overflow: hidden; border-radius: 24px;
    background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0,0,0,.08);
}
.lg-card-head {
    padding: 1.1rem 1.5rem; font-weight: 700; color: var(--bs-heading-color);
    border-bottom: 1px solid var(--bs-border-color);
    background: linear-gradient(135deg, rgba(13,110,253,.05), rgba(255,193,7,.04));
}
.lg-table {
    --bs-table-bg: transparent; --bs-table-color: var(--bs-body-color);
    --bs-table-border-color: var(--bs-border-color); margin: 0;
}
.lg-table thead th {
    background: var(--bs-tertiary-bg); color: var(--bs-secondary-color);
    font-size: .75rem; text-transform: uppercase; letter-spacing: .04em;
    padding: .9rem 1rem; white-space: nowrap;
}
.lg-table td { padding: .85rem 1rem; vertical-align: middle; }
.lg-table tbody tr:hover { background: rgba(13,110,253,.04); }

.lg-user { display: inline-flex; align-items: center; gap: 9px; font-weight: 600; }
.lg-avatar {
    width: 32px; height: 32px; border-radius: 50%; display: inline-flex;
    align-items: center; justify-content: center; font-size: 13px; font-weight: 700;
    color: #0d6efd; background: rgba(13,110,253,.12); border: 1px solid rgba(13,110,253,.18);
}
.lg-tag {
    display: inline-flex; align-items: center; gap: 6px; padding: 5px 11px;
    border-radius: 50px; font-size: .74rem; font-weight: 700; white-space: nowrap;
}
.tg-setuju { background: rgba(25,135,84,.15);  color: #198754; }
.tg-tolak  { background: rgba(220,53,69,.15);  color: #dc3545; }
.tg-kembali{ background: rgba(13,110,253,.15); color: #0d6efd; }
.tg-ajukan { background: rgba(255,193,7,.20);  color: #b38600; }
.tg-alat   { background: rgba(111,66,193,.15); color: #6f42c1; }
.tg-lain   { background: rgba(108,117,125,.15);color: #6c757d; }

.lg-time { color: var(--bs-secondary-color); font-size: .85rem; white-space: nowrap; }

/* Bola voli (tanpa border putih) */
.volleyball {
    position: fixed; width: 80px; height: 80px; border-radius: 50%;
    background: var(--bs-tertiary-bg); border: none;
    box-shadow: 0 12px 28px rgba(0,0,0,.15); z-index: 1; opacity: .9;
    pointer-events: none; bottom: 6%; right: 5%;
    animation: floating 4s ease-in-out infinite;
}
.volleyball::before {
    content: ""; position: absolute; width: 64px; height: 32px;
    border-top: 5px solid #0d6efd; border-radius: 50%; top: 13px; left: 4px; transform: rotate(35deg);
}
.volleyball::after {
    content: ""; position: absolute; width: 52px; height: 26px;
    border-bottom: 5px solid #ffc107; border-radius: 50%; bottom: 13px; right: 4px; transform: rotate(-35deg);
}
@keyframes floating {
    0%,100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(8deg); }
}

@media (max-width: 991px) { .lg-page, :root:has(#sidebarToggle:checked) .lg-page { left: 0; } }
@media (max-width: 768px) {
    .lg-content { padding: 80px 15px 30px; }
    .lg-head-card { padding: 22px 18px; }
    .volleyball { display: none; }
}
</style>

@php
    $namaUser = [];
    foreach ($users as $u) { $namaUser[$u->id] = $u->username; }

    $hariIni = date('Y-m-d');
    $jumlahHariIni = 0;
    $pelaku = [];

    foreach ($semua as $l) {
        if (substr((string) $l->created_at, 0, 10) === $hariIni) { $jumlahHariIni++; }
        if ($l->id_user) { $pelaku[$l->id_user] = true; }
    }

    $cari = trim((string) request('cari'));
@endphp

<section class="lg-page">

    <div class="volleyball"></div>

    <div class="lg-content">

        {{-- CARD HEADER --}}
        <div class="lg-head-card">
            <div class="lg-head-inner d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">

                <div>
                    <span class="badge rounded-pill badge-volley px-4 py-2 mb-3">📜 AREA ADMIN</span>
                    <div class="volley-line"></div>
                    <h1 class="display-6 fw-bold mb-1 lg-title">Log <span>Aktivitas</span></h1>
                    <p class="text-secondary mb-0">Riwayat aktivitas pengguna di sistem.</p>
                </div>

                <form method="GET" action="{{ route('admin.log') }}" class="lg-search">
                    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari aktivitas / user...">
                    <button type="submit" class="btn btn-volley px-3">Cari</button>
                </form>

            </div>
        </div>

        {{-- RINGKASAN --}}
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="lg-stat">
                    <div class="lg-stat-icon">📋</div>
                    <div><small>Total tercatat</small><strong>{{ count($semua) }}</strong></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="lg-stat">
                    <div class="lg-stat-icon kuning">🕘</div>
                    <div><small>Hari ini</small><strong>{{ $jumlahHariIni }}</strong></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="lg-stat">
                    <div class="lg-stat-icon">👥</div>
                    <div><small>User aktif</small><strong>{{ count($pelaku) }}</strong></div>
                </div>
            </div>
        </div>

        {{-- TABEL --}}
        <div class="lg-card">

            <div class="lg-card-head">
                📜 Riwayat Aktivitas
                @if ($cari !== '')
                    <span class="text-secondary fw-normal small ms-2">hasil untuk "{{ $cari }}"</span>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table lg-table">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>User</th>
                            <th>Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($data as $l)

                            @php
                                $nama = $l->id_user ? ($namaUser[$l->id_user] ?? 'User ' . $l->id_user) : 'Sistem';
                                $teks = strtolower((string) $l->aktivitas);

                                if (strpos($teks, 'menyetujui') !== false)      { $kelas = 'tg-setuju';  $ikon = '✔'; }
                                elseif (strpos($teks, 'menolak') !== false)     { $kelas = 'tg-tolak';   $ikon = '✖'; }
                                elseif (strpos($teks, 'kembali') !== false
                                     || strpos($teks, 'pengembalian') !== false
                                     || strpos($teks, 'kondisi') !== false)     { $kelas = 'tg-kembali'; $ikon = '↩'; }
                                elseif (strpos($teks, 'mengajukan') !== false)  { $kelas = 'tg-ajukan';  $ikon = '📝'; }
                                elseif (strpos($teks, 'alat') !== false)        { $kelas = 'tg-alat';    $ikon = '🏐'; }
                                else                                            { $kelas = 'tg-lain';    $ikon = '•'; }
                            @endphp

                            <tr>
                                <td class="lg-time">
                                    {{ $l->created_at ? date('d M Y, H:i', strtotime($l->created_at)) : '-' }}
                                </td>

                                <td>
                                    <span class="lg-user">
                                        <span class="lg-avatar">{{ strtoupper(substr($nama, 0, 1)) }}</span>
                                        {{ $nama }}
                                    </span>
                                </td>

                                <td>
                                    <span class="lg-tag {{ $kelas }}">{{ $ikon }}</span>
                                    {{ $l->aktivitas }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center py-5 text-secondary">
                                    <div style="font-size: 2.5rem;">🏐</div>
                                    @if ($cari !== '')
                                        Tidak ada aktivitas yang cocok.
                                    @else
                                        Belum ada aktivitas tercatat.
                                    @endif
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>

            @if (method_exists($data, 'hasPages') && $data->hasPages())
                <div class="p-3 d-flex justify-content-end">{!! $data->links() !!}</div>
            @endif

        </div>

    </div>
</section>

@endsection