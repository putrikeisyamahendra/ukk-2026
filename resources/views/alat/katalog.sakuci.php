@extends('layouts.app')

@section('title', 'Katalog Alat')

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

.kt-card {
    height: 100%; display: flex; flex-direction: column; padding: 22px;
    border-radius: 24px; background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0,0,0,.07); transition: all .3s ease;
}
.kt-card:hover {
    transform: translateY(-5px); border-color: #0d6efd;
    box-shadow: 0 14px 30px rgba(13,110,253,.15);
}
.kt-tags { display: flex; justify-content: space-between; align-items: center; gap: 8px; margin-bottom: 14px; }
.kt-code {
    padding: 4px 10px; border-radius: 8px; background: rgba(13,110,253,.08);
    border: 1px solid rgba(13,110,253,.15); color: #0d6efd; font-size: 12px; font-weight: 600;
}
.kt-kat {
    padding: 4px 10px; border-radius: 8px; background: rgba(255,193,7,.14);
    border: 1px solid rgba(255,193,7,.3); color: #b38600; font-size: 11px;
    font-weight: 700; text-transform: uppercase; text-align: right;
}
.kt-name { color: var(--bs-heading-color); font-weight: 700; margin-bottom: 10px; }
.kt-stok { flex: 1; margin-bottom: 16px; }
.badge-stok {
    display: inline-block; padding: .35rem .65rem; border-radius: 8px;
    background: rgba(25,135,84,.12); color: #198754; font-weight: 700; font-size: .85rem;
}
.badge-stok.nol { background: rgba(220,53,69,.12); color: #dc3545; }
.kt-card hr { margin: 0 0 16px; border-color: var(--bs-border-color); opacity: 1; }
.kt-empty { padding: 50px 20px; text-align: center; color: var(--bs-secondary-color); }

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

@media (max-width: 768px) {
    .alat-header { min-height: 280px; padding: 1.5rem; }
    .alat-search { flex-direction: column; }
    .alat-search input, .alat-search button { width: 100%; }
    .volleyball { width: 65px; height: 65px; }
    .volleyball::before { width: 52px; height: 25px; border-width: 4px; }
    .volleyball::after { width: 45px; height: 20px; border-width: 4px; }
    .ball-one { top: 7%; right: 4%; }
    .ball-two { display: none; }
}
</style>

@php
    $namaKat = [];
    foreach ($kategori as $k) {
        $namaKat[$k->id_kategori] = $k->nama_kategori;
    }
@endphp

<div class="container py-3 py-lg-4 alat-page">

    {{-- HEADER --}}
    <section class="alat-header">

        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>

        <div class="alat-header-content">

            <span class="badge rounded-pill badge-volley px-4 py-2 mb-4">🏐 KATALOG ALAT</span>

            <div class="volley-line"></div>

            <h1 class="display-6 fw-bold mb-3 alat-title">
                Daftar <span class="text-volley">Alat Tersedia</span>
            </h1>

            <p class="lead alat-description mb-0" style="max-width: 650px;">
                Pilih alat yang ingin kamu ajukan untuk dipinjam.
            </p>

        </div>

    </section>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('alat.katalog') }}" class="alat-search">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / kode alat...">
        <button type="submit" class="btn btn-volley">🔍 Cari</button>
    </form>

    {{-- KARTU ALAT --}}
    <div class="row g-4">

        @forelse ($datal as $alat)

            <div class="col-md-6 col-xl-4">
                <div class="kt-card">

                    <div class="kt-tags">
                        <span class="kt-code">{{ $alat->kode_alat }}</span>
                        <span class="kt-kat">{{ $namaKat[$alat->id_kategori] ?? '-' }}</span>
                    </div>

                    <h2 class="h5 kt-name">{{ $alat->nama_alat }}</h2>

                    <div class="kt-stok">
                        <span class="badge-stok {{ (int) $alat->stok <= 0 ? 'nol' : '' }}">
                            Stok: {{ (int) $alat->stok }}
                        </span>
                    </div>

                    <hr>

                    <a href="{{ route('peminjam.ajukan') }}?alat={{ $alat->id_alat }}"
                       class="btn btn-volley w-100 py-2">
                        Ajukan Pinjam
                    </a>

                </div>
            </div>

        @empty

            <div class="col-12">
                <div class="kt-empty">
                    <div style="font-size: 2.5rem;">🏐</div>
                    @if (request('search'))
                        Tidak ada alat dengan kata kunci <strong>"{{ request('search') }}"</strong>.
                    @else
                        Belum ada alat yang tersedia.
                    @endif
                </div>
            </div>

        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">{!! $datal->links() !!}</div>

</div>

@endsection