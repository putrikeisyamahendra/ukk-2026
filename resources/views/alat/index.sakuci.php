@extends('layouts.app')

@section('title', config('app.name') . ' -- Manajemen Alat Voli')

@section('content')

<style>
.alat-page { position: relative; overflow: hidden; }

.alat-header {
    position: relative; min-height: 280px; display: flex; align-items: center;
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
    display: flex; align-items: center; gap: 10px; padding: 15px; margin-bottom: 1.5rem;
    border-radius: 20px; background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color); box-shadow: 0 12px 35px rgba(0,0,0,.06);
}
.alat-search input {
    flex: 1; min-width: 0; height: 46px; padding: .7rem 1rem; border-radius: 12px;
    border: 1px solid var(--bs-border-color); background-color: var(--bs-body-bg);
    color: var(--bs-body-color); outline: none;
}
.alat-search input::placeholder { color: var(--bs-secondary-color); }
.alat-search input:focus { border-color: #0d6efd; box-shadow: 0 0 0 3px rgba(13,110,253,.12); }
.alat-search button { height: 46px; padding: 0 1.25rem; }

.alat-card {
    overflow: hidden; border-radius: 24px; background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color); box-shadow: 0 12px 35px rgba(0,0,0,.07);
}
.alat-card-header {
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

.alat-code {
    display: inline-block; padding: .35rem .65rem; border-radius: 8px;
    background: rgba(13,110,253,.08); border: 1px solid rgba(13,110,253,.12);
    color: #0d6efd; font-size: .8rem;
}
.badge-kategori {
    display: inline-block; padding: .4rem .7rem; border-radius: 9px;
    background: rgba(255,193,7,.12); border: 1px solid rgba(255,193,7,.25);
    color: #b38600; font-size: .8rem; font-weight: 600;
}
.badge-stok {
    display: inline-block; padding: .35rem .65rem; border-radius: 8px;
    background: rgba(25,135,84,.12); color: #198754; font-weight: 700; font-size: .85rem;
}
.badge-stok.nol { background: rgba(220,53,69,.12); color: #dc3545; }

.btn-action { padding: .4rem .7rem; border-radius: 9px; font-size: .8rem; font-weight: 600; }
.btn-delete-volley {
    color: #b38600; border: 1px solid #ffc107; background: transparent;
    border-radius: 9px; padding: .4rem .7rem; font-size: .8rem; font-weight: 600;
    transition: all .2s ease;
}
.btn-delete-volley:hover {
    color: #102a43; background: linear-gradient(135deg, #ffc107, #ffda44); border-color: #ffc107;
}

/* BOLA VOLI (sama seperti Kategori, tanpa garis putih) */
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
    .alat-header { min-height: 330px; padding: 1.5rem; }
    .alat-header .row { text-align: center; }
    .alat-header .volley-line { margin-left: auto; margin-right: auto; }
    .alat-header .btn-volley { width: 100%; }
    .alat-search { flex-direction: column; }
    .alat-search input, .alat-search button { width: 100%; }
    .volleyball { width: 65px; height: 65px; }
    .volleyball::before { width: 52px; height: 25px; border-width: 4px; }
    .volleyball::after { width: 45px; height: 20px; border-width: 4px; }
    .ball-one { top: 7%; right: 4%; }
    .ball-two { display: none; }
}
</style>

<div class="container py-3 py-lg-4 alat-page">

    {{-- HEADER --}}
    <section class="alat-header">

        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>

        <div class="alat-header-content">

            <span class="badge rounded-pill badge-volley px-4 py-2 mb-4">
                🏐 MANAJEMEN INVENTARIS VOLI
            </span>

            <div class="volley-line"></div>

            <div class="row align-items-center">

                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-3 alat-title">
                        Daftar <span class="text-volley">Alat Voli</span>
                    </h1>

                    <p class="lead alat-description mb-0" style="max-width: 650px;">
                        Kelola data alat olahraga voli dan kategorinya
                        dengan mudah, cepat, dan terorganisir.
                    </p>
                </div>

                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <a href="{{ route('alat.create') }}" class="btn btn-volley btn-lg px-4">
                        + Tambah Alat
                    </a>
                </div>

            </div>

        </div>

    </section>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success" style="border-radius: 14px;">✅ {{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" style="border-radius: 14px;">⚠️ {{ session('error') }}</div>
    @endif

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('alat.index') }}" class="alat-search">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama alat...">
        <button type="submit" class="btn btn-volley">🔍 Cari</button>
    </form>

    {{-- TABEL --}}
    <div class="alat-card">

        <div class="alat-card-header">
            <div class="alat-card-title">📋 Data Alat</div>
            <div class="alat-card-subtitle">Daftar alat olahraga voli yang tersedia.</div>
        </div>

        <div class="table-responsive">
            <table class="table table-volley align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Alat</th>
                        <th>Kode Alat</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $no = 1;
                        $namaKat = [];
                        foreach ($kategori as $k) { $namaKat[$k->id_kategori] = $k->nama_kategori; }
                    @endphp

                    @forelse ($datal as $alats)
                        <tr>
                            <td class="text-secondary">{{ $no++ }}</td>
                            <td class="fw-semibold">{{ $alats->nama_alat }}</td>
                            <td><code class="alat-code">{{ $alats->kode_alat }}</code></td>
                            <td><span class="badge-kategori">{{ $namaKat[$alats->id_kategori] ?? '-' }}</span></td>
                            <td>
                                <span class="badge-stok {{ (int) $alats->stok <= 0 ? 'nol' : '' }}">{{ (int) $alats->stok }}</span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('alat.edit', ['id_alat' => $alats->id_alat]) }}"
                                       class="btn btn-outline-primary btn-action text-decoration-none">Edit</a>

                                    <form action="{{ route('alat.delete', ['id_alat' => $alats->id_alat]) }}"
                                          method="POST" class="d-inline mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete-volley"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-secondary">
                                <div class="mb-3" style="font-size: 2.5rem;">🏐</div>
                                @if (request('search'))
                                    <div class="fw-semibold mb-1">Alat tidak ditemukan</div>
                                    <div>Tidak ada alat dengan nama <strong>"{{ request('search') }}"</strong>.</div>
                                @else
                                    <div class="fw-semibold mb-1">Belum ada data alat</div>
                                    <div>Silakan tambahkan alat terlebih dahulu.</div>
                                @endif
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

    <div class="mt-4">{!! $datal->links() !!}</div>

</div>

@endsection