@extends('layouts.app')

@section('title', 'Katalog Alat')

@section('content')

<style>
html:has(.kt-page),
html:has(.kt-page) body {
    overflow: hidden;
}

.kt-page {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 260px;
    z-index: 1;
    overflow-x: hidden;
    overflow-y: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    color: var(--bs-body-color);
    transition: left .3s ease;
}

.kt-page::-webkit-scrollbar {
    display: none;
}

:root:has(#sidebarToggle:checked) .kt-page {
    left: 0;
}

.kt-page::before {
    content: "";
    position: fixed;
    width: 420px;
    height: 420px;
    background: rgba(13, 110, 253, 0.08);
    border-radius: 50%;
    top: -180px;
    left: -130px;
    pointer-events: none;
}

.kt-page::after {
    content: "";
    position: fixed;
    width: 330px;
    height: 330px;
    background: rgba(255, 193, 7, 0.10);
    border-radius: 50%;
    bottom: -160px;
    right: -100px;
    pointer-events: none;
}

.kt-content {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 1100px;
    margin: 0 auto;
    padding: 90px 24px 40px;
}

.badge-volley {
    background: linear-gradient(135deg, #0d6efd, #084298);
    color: #fff;
    font-weight: 600;
    box-shadow: 0 6px 18px rgba(13, 110, 253, 0.25);
}

.volley-line {
    width: 65px;
    height: 4px;
    margin: 0 0 16px;
    border-radius: 10px;
    background: linear-gradient(90deg, #0d6efd, #ffc107);
}

.kt-title {
    color: var(--bs-heading-color);
    letter-spacing: -1px;
}

.text-volley {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.kt-desc {
    color: var(--bs-secondary-color);
}

/* Pencarian */
.kt-search {
    display: flex;
    gap: 8px;
    width: 100%;
    max-width: 380px;
}

.kt-search input {
    flex: 1;
    min-width: 0;
    height: 46px;
    padding: 0 14px;
    border-radius: 12px;
    border: 1px solid var(--bs-border-color);
    background: var(--bs-body-bg);
    color: var(--bs-body-color);
    outline: none;
}

.kt-search input::placeholder {
    color: var(--bs-secondary-color);
}

.kt-search input:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.12);
}

.btn-volley {
    border: none;
    border-radius: 12px;
    font-weight: 700;
    color: #fff;
    background: linear-gradient(135deg, #0d6efd, #084298);
    box-shadow: 0 7px 18px rgba(13, 110, 253, 0.22);
    transition: all 0.3s ease;
}

.btn-volley:hover {
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 11px 25px rgba(13, 110, 253, 0.32);
}

/* Kartu alat */
.kt-card {
    height: 100%;
    display: flex;
    flex-direction: column;
    padding: 22px;
    border-radius: 20px;
    background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
    transition: all .3s ease;
}

.kt-card:hover {
    transform: translateY(-5px);
    border-color: #0d6efd;
    box-shadow: 0 14px 30px rgba(13, 110, 253, 0.15);
}

.kt-tags {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
}

.kt-code {
    padding: 4px 10px;
    border-radius: 8px;
    background: rgba(13, 110, 253, 0.08);
    border: 1px solid rgba(13, 110, 253, 0.15);
    color: #0d6efd;
    font-size: 12px;
    font-weight: 600;
}

.kt-kat {
    padding: 4px 10px;
    border-radius: 8px;
    background: rgba(255, 193, 7, 0.14);
    border: 1px solid rgba(255, 193, 7, 0.3);
    color: #b38600;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    text-align: right;
}

.kt-name {
    flex: 1;
    margin-bottom: 18px;
    color: var(--bs-heading-color);
    font-weight: 700;
}

.kt-card hr {
    margin: 0 0 16px;
    border-color: var(--bs-border-color);
    opacity: 1;
}

.kt-empty {
    padding: 50px 20px;
    text-align: center;
    color: var(--bs-secondary-color);
}

/* Bola voli (tanpa border putih) */
.volleyball {
    position: fixed;
    width: 85px;
    height: 85px;
    border-radius: 50%;
    background: var(--bs-tertiary-bg);
    border: none;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
    z-index: 1;
    opacity: 0.9;
    pointer-events: none;
    top: 100px;
    right: 6%;
    animation: floating 4s ease-in-out infinite;
}

.volleyball::before {
    content: "";
    position: absolute;
    width: 68px;
    height: 34px;
    border-top: 5px solid #0d6efd;
    border-radius: 50%;
    top: 14px;
    left: 4px;
    transform: rotate(35deg);
}

.volleyball::after {
    content: "";
    position: absolute;
    width: 56px;
    height: 28px;
    border-bottom: 5px solid #ffc107;
    border-radius: 50%;
    bottom: 14px;
    right: 4px;
    transform: rotate(-35deg);
}

@keyframes floating {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(8deg); }
}

@media (max-width: 991px) {
    .kt-page,
    :root:has(#sidebarToggle:checked) .kt-page {
        left: 0;
    }
}

@media (max-width: 768px) {
    .kt-content {
        padding: 80px 15px 30px;
    }

    .volleyball {
        display: none;
    }
}
</style>

@php
    // Peta id kategori => nama kategori
    $namaKat = [];
    foreach ($kategori as $k) {
        $namaKat[$k->id_kategori] = $k->nama_kategori;
    }
@endphp

<section class="kt-page">

    <div class="volleyball"></div>

    <div class="kt-content">

        {{-- HEADER --}}

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">

            <div>
                <span class="badge rounded-pill badge-volley px-4 py-2 mb-3">
                    🏐 KATALOG ALAT
                </span>

                <div class="volley-line"></div>

                <h1 class="display-6 fw-bold mb-2 kt-title">
                    Daftar <span class="text-volley">Alat Tersedia</span>
                </h1>

                <p class="kt-desc mb-0">
                    Pilih alat yang ingin Anda ajukan untuk dipinjam.
                </p>
            </div>

            <form method="GET" action="{{ route('alat.index') }}" class="kt-search">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nama / kode alat...">
                <button type="submit" class="btn btn-volley px-4">Cari</button>
            </form>

        </div>


        {{-- KARTU ALAT --}}

        <div class="row g-4">

            @forelse ($datal as $alat)

                <div class="col-md-6 col-xl-4">

                    <div class="kt-card">

                        <div class="kt-tags">
                            <span class="kt-code">{{ $alat->kode_alat }}</span>
                            <span class="kt-kat">
                                {{ $namaKat[$alat->id_kategori] ?? '-' }}
                            </span>
                        </div>

                        <h2 class="h5 kt-name">{{ $alat->nama_alat }}</h2>

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
                            Tidak ada alat dengan kata kunci
                            <strong>"{{ request('search') }}"</strong>.
                        @else
                            Belum ada alat yang tersedia.
                        @endif
                    </div>
                </div>

            @endforelse

        </div>


        {{-- PAGINATION --}}

        <div class="mt-4">
            {!! $datal->links() !!}
        </div>

    </div>

</section>

@endsection