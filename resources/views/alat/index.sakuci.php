@extends('layouts.app')

@section('title', config('app.name') . ' -- Manajemen Alat Voli')

@section('content')@extends('layouts.app')

@section('title', config('app.name') . ' -- Manajemen Alat Voli')

@section('content')

<style> /* ========================================================= VOLLEYBALL THEME ========================================================= */
.alat-page {
    position: relative;
    overflow: hidden;
}

.alat-header {
    position: relative;
    min-height: 280px;
    display: flex;
    align-items: center;
    overflow: hidden;
    padding: 2rem;
    border-radius: 24px;
    background: linear-gradient(
        135deg,
        var(--bs-body-bg),
        var(--bs-secondary-bg)
    );
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
    margin-bottom: 1.5rem;
}

.alat-header::before {
    content: "";
    position: absolute;
    width: 420px;
    height: 420px;
    background: rgba(13, 110, 253, 0.08);
    border-radius: 50%;
    top: -220px;
    right: -120px;
}

.alat-header::after {
    content: "";
    position: absolute;
    width: 330px;
    height: 330px;
    background: rgba(255, 193, 7, 0.10);
    border-radius: 50%;
    bottom: -190px;
    left: -100px;
}

.alat-header-content {
    position: relative;
    z-index: 2;
    width: 100%;
}

/* =========================================================
   BADGE
========================================================= */

.badge-volley {
    display: inline-block;
    background: linear-gradient(
        135deg,
        #0d6efd,
        #084298
    );
    color: #fff;
    font-weight: 700;
    box-shadow: 0 6px 18px rgba(13, 110, 253, 0.25);
}

/* =========================================================
   TITLE
========================================================= */

.alat-title {
    color: var(--bs-heading-color);
    letter-spacing: -1px;
}

.text-volley {
    background: linear-gradient(
        90deg,
        #0d6efd,
        #084298
    );
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.alat-description {
    color: var(--bs-secondary-color);
    line-height: 1.8;
}

.volley-line {
    width: 65px;
    height: 4px;
    margin-bottom: 20px;
    border-radius: 10px;
    background: linear-gradient(
        90deg,
        #0d6efd,
        #ffc107
    );
}

/* =========================================================
   BUTTON BLUE
========================================================= */

.btn-volley {
    border: none;
    border-radius: 12px;
    font-weight: 700;
    color: #fff;
    background: linear-gradient(
        135deg,
        #0d6efd,
        #084298
    );
    box-shadow: 0 7px 18px rgba(13, 110, 253, 0.22);
    transition: all 0.3s ease;
}

.btn-volley:hover {
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 11px 25px rgba(13, 110, 253, 0.32);
}

/* =========================================================
   SEARCH
========================================================= */

.alat-search {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 15px;
    margin-bottom: 1.5rem;
    border-radius: 20px;
    background: color-mix(
        in srgb,
        var(--bs-body-bg) 85%,
        transparent
    );
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.06);
    backdrop-filter: blur(10px);
}

.alat-search input {
    flex: 1;
    min-width: 0;
    height: 46px;
    padding: 0.7rem 1rem;
    border-radius: 12px;
    border: 1px solid var(--bs-border-color);
    background-color: var(--bs-body-bg);
    color: var(--bs-body-color);
    outline: none;
    transition: all 0.2s ease;
}

.alat-search input::placeholder {
    color: var(--bs-secondary-color);
}

.alat-search input:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.12);
}

.alat-search button {
    height: 46px;
    padding-left: 1.25rem;
    padding-right: 1.25rem;
}

/* =========================================================
   TABLE CARD
========================================================= */

.alat-card {
    overflow: hidden;
    border-radius: 24px;
    background: color-mix(
        in srgb,
        var(--bs-body-bg) 92%,
        transparent
    );
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.07);
    backdrop-filter: blur(10px);
}

.alat-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--bs-border-color);
    background: linear-gradient(
        135deg,
        rgba(13, 110, 253, 0.05),
        rgba(255, 193, 7, 0.04)
    );
}

.alat-card-title {
    color: var(--bs-heading-color);
    font-weight: 700;
    font-size: 1rem;
}

.alat-card-subtitle {
    color: var(--bs-secondary-color);
    font-size: 0.85rem;
}

/* =========================================================
   TABLE
========================================================= */

.table-volley {
    margin-bottom: 0;
}

.table-volley thead th {
    padding: 1rem;
    background-color: var(--bs-tertiary-bg);
    color: var(--bs-secondary-color);
    border-bottom: 1px solid var(--bs-border-color);
    font-size: 0.78rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    white-space: nowrap;
}

.table-volley tbody td {
    padding: 1rem;
    vertical-align: middle;
    color: var(--bs-body-color);
    border-bottom: 1px solid var(--bs-border-color);
}

.table-volley tbody tr {
    transition: all 0.2s ease;
}

.table-volley tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.035);
}

.table-volley tbody tr:last-child td {
    border-bottom: none;
}

/* =========================================================
   KODE ALAT
========================================================= */

.alat-code {
    display: inline-block;
    padding: 0.35rem 0.65rem;
    border-radius: 8px;
    background-color: rgba(13, 110, 253, 0.08);
    border: 1px solid rgba(13, 110, 253, 0.12);
    color: #0d6efd;
    font-size: 0.8rem;
}

/* =========================================================
   BADGE KATEGORI
========================================================= */

.badge-kategori {
    display: inline-block;
    padding: 0.4rem 0.7rem;
    border-radius: 9px;
    background: rgba(255, 193, 7, 0.12);
    border: 1px solid rgba(255, 193, 7, 0.25);
    color: #b38600;
    font-size: 0.8rem;
    font-weight: 600;
}

/* =========================================================
   ACTION
========================================================= */

.btn-action {
    padding: 0.4rem 0.7rem;
    border-radius: 9px;
    font-size: 0.8rem;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-action:hover {
    transform: translateY(-1px);
}

/* =========================================================
   DELETE BUTTON - YELLOW
========================================================= */

.btn-delete-volley {
    color: #b38600;
    border: 1px solid #ffc107;
    background: transparent;
    border-radius: 9px;
    padding: 0.4rem 0.7rem;
    font-size: 0.8rem;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-delete-volley:hover {
    color: #102a43;
    background: linear-gradient(
        135deg,
        #ffc107,
        #ffda44
    );
    border-color: #ffc107;
    transform: translateY(-1px);
    box-shadow: 0 5px 12px rgba(255, 193, 7, 0.25);
}

/* =========================================================
   VOLLEYBALL DECORATION
========================================================= */

.volleyball {
    position: absolute;
    width: 105px;
    height: 105px;
    border-radius: 50%;
    background: var(--bs-body-bg);
    border: 4px solid var(--bs-heading-color);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
    z-index: 1;
    opacity: 0.95;
}

.volleyball::before {
    content: "";
    position: absolute;
    width: 85px;
    height: 42px;
    border-top: 6px solid #0d6efd;
    border-radius: 50%;
    top: 17px;
    left: 5px;
    transform: rotate(35deg);
}

.volleyball::after {
    content: "";
    position: absolute;
    width: 70px;
    height: 35px;
    border-bottom: 6px solid #ffc107;
    border-radius: 50%;
    bottom: 17px;
    right: 5px;
    transform: rotate(-35deg);
}

.ball-one {
    top: 15%;
    right: 7%;
    animation: floating 4s ease-in-out infinite;
}

.ball-two {
    bottom: 8%;
    right: 2%;
    width: 75px;
    height: 75px;
    opacity: 0.65;
    animation: floating 5s ease-in-out infinite reverse;
}

.ball-two::before {
    width: 60px;
    height: 30px;
    border-width: 4px;
}

.ball-two::after {
    width: 50px;
    height: 25px;
    border-width: 4px;
}

@keyframes floating {
    0%,
    100% {
        transform: translateY(0) rotate(0deg);
    }

    50% {
        transform: translateY(-15px) rotate(8deg);
    }
}

/* =========================================================
   DARK MODE
========================================================= */

[data-bs-theme="dark"] .alat-header {
    background: linear-gradient(
        135deg,
        var(--bs-body-bg),
        #172033
    );
}

[data-bs-theme="dark"] .alat-header::before {
    background: rgba(13, 110, 253, 0.12);
}

[data-bs-theme="dark"] .alat-header::after {
    background: rgba(255, 193, 7, 0.08);
}

[data-bs-theme="dark"] .alat-card {
    background: rgba(255, 255, 255, 0.04);
}

[data-bs-theme="dark"] .alat-search {
    background: rgba(255, 255, 255, 0.04);
}

[data-bs-theme="dark"] .table-volley tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.07);
}

[data-bs-theme="dark"] .badge-kategori {
    color: #ffd95a;
}

[data-bs-theme="dark"] .btn-delete-volley {
    color: #ffd95a;
}

/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 768px) {

    .alat-header {
        min-height: 330px;
        padding: 1.5rem;
    }

    .alat-header .row {
        text-align: center;
    }

    .alat-header .volley-line {
        margin-left: auto;
        margin-right: auto;
    }

    .alat-header .btn-volley {
        width: 100%;
    }

    .alat-search {
        flex-direction: column;
    }

    .alat-search input {
        width: 100%;
    }

    .alat-search button {
        width: 100%;
    }

    .alat-card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }

    .volleyball {
        width: 65px;
        height: 65px;
    }

    .volleyball::before {
        width: 52px;
        height: 25px;
        border-width: 4px;
    }

    .volleyball::after {
        width: 45px;
        height: 20px;
        border-width: 4px;
    }

    .ball-one {
        top: 7%;
        right: 4%;
    }

    .ball-two {
        display: none;
    }

    .table-volley thead th,
    .table-volley tbody td {
        padding: 0.75rem;
    }
}

</style> <div class="container py-3 py-lg-4 alat-page">
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
                    Daftar
                    <span class="text-volley">
                        Alat Voli
                    </span>
                </h1>

                <p class="lead alat-description mb-0"
                   style="max-width: 650px;">

                    Kelola data alat olahraga voli dan
                    kategorinya dengan mudah, cepat, dan terorganisir.

                </p>

            </div>

            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

                <a
                    href="{{ route('alat.create') }}"
                    class="btn btn-volley btn-lg px-4">

                    + Tambah Alat

                </a>

            </div>

        </div>

    </div>

</section>

{{-- SEARCH --}}
<form
    method="GET"
    action="{{ route('alat.index') }}"
    class="alat-search">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Cari nama alat..."
    >

    <button
        type="submit"
        class="btn btn-volley">

        🔍 Cari

    </button>

</form>

{{-- TABLE --}}
<div class="alat-card">

    <div class="alat-card-header">

        <div>

            <div class="alat-card-title">
                📋 Data Alat
            </div>

            <div class="alat-card-subtitle">
                Daftar alat olahraga voli yang tersedia.
            </div>

        </div>

        @if(request('search'))

            <div class="alat-card-subtitle">

                Hasil pencarian:
                <strong>
                    "{{ request('search') }}"
                </strong>

            </div>

        @endif

    </div>

    <div class="table-responsive">

        <table class="table table-volley align-middle">

            <thead>

                <tr>

                    <th style="width: 7%;">
                        NO
                    </th>

                    <th style="width: 27%;">
                        NAMA ALAT
                    </th>

                    <th style="width: 21%;">
                        KODE ALAT
                    </th>

                    <th style="width: 25%;">
                        KATEGORI
                    </th>

                    <th
                        class="text-end"
                        style="width: 20%;">

                        AKSI

                    </th>

                </tr>

            </thead>

            <tbody>

                @php
                    $no = 1;
                @endphp

                @forelse ($datal as $alats)

                    <tr>

                        <td class="text-secondary">
                            {{ $no++ }}
                        </td>

                        <td class="fw-semibold">
                            {{ $alats->nama_alat }}
                        </td>

                        <td>

                            <code class="alat-code">
                                {{ $alats->kode_alat }}
                            </code>

                        </td>

                        <td>

                            @php
                                $namaKategori = '-';

                                foreach ($kategori as $k) {
                                    if ($k->id_kategori == $alats->id_kategori) {
                                        $namaKategori = $k->nama_kategori;
                                        break;
                                    }
                                }
                            @endphp

                            <span class="badge-kategori">
                                {{ $namaKategori }}
                            </span>

                        </td>

                        <td class="text-end">

                            <div class="d-inline-flex gap-1">

                                {{-- EDIT --}}
                                <a
                                    href="{{ route('alat.edit', ['alat' => $alats->id_alat]) }}"
                                    class="btn btn-outline-primary btn-action text-decoration-none">

                                    Edit

                                </a>

                                {{-- DELETE --}}
                                <form
                                    action="{{ route('alat.delete', ['id' => $alats->id_alat]) }}"
                                    method="POST"
                                    class="d-inline mb-0">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-delete-volley"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="text-center py-5 text-secondary">

                            <div
                                class="mb-3"
                                style="font-size: 2.5rem;">

                                🏐

                            </div>

                            @if(request('search'))

                                <div class="fw-semibold mb-1">
                                    Alat tidak ditemukan
                                </div>

                                <div>
                                    Tidak ada alat dengan nama
                                    <strong>
                                        "{{ request('search') }}"
                                    </strong>.
                                </div>

                            @else

                                <div class="fw-semibold mb-1">
                                    Belum ada data alat
                                </div>

                                <div>
                                    Silakan tambahkan alat terlebih dahulu.
                                </div>

                            @endif

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- PAGINATION --}}
<div class="mt-4">

    {!! $datal->links() !!}

</div>

</div>
@endsection

    <style>
        /* |-------------------------------------------------------------------------- */
        /* | CLEAN & MINIMALIST VOLLEYBALL THEME */
        /* |-------------------------------------------------------------------------- */
        .page-header {
            background-color: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color);
            border-radius: 1rem;
            padding: 1.75rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }

        .tag-volley {
            display: inline-block;
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
            font-weight: 600;
            font-size: 0.8rem;
            padding: 0.25rem 0.75rem;
            border-radius: 50rem;
            margin-bottom: 0.5rem;
        }

        /* Tombol Utama Minimalis Solid */
        .btn-volley-solid {
            background-color: #0d6efd;
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            transition: background-color 0.15s ease;
        }
        .btn-volley-solid:hover {
            background-color: #0b5ed7;
            color: #fff;
        }

        .card-clean {
            border: 1px solid var(--bs-border-color);
            border-radius: 1rem;
            background-color: var(--bs-body-bg);
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        }

        .table-clean thead th {
            background-color: var(--bs-tertiary-bg);
            border-bottom: 1px solid var(--bs-border-color);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: var(--bs-secondary-color);
            padding: 0.85rem 1rem;
        }

        .table-clean tbody td {
            padding: 0.85rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--bs-border-color);
        }

        .table-clean tbody tr:last-child td {
            border-bottom: none;
        }

        .badge-kategori-clean {
            background-color: rgba(255, 193, 7, 0.15);
            color: #b78103;
            font-weight: 600;
            border-radius: 0.35rem;
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }

        code.inline-code {
            background-color: var(--bs-tertiary-bg);
            padding: 0.2rem 0.4rem;
            border-radius: 0.25rem;
            font-size: 0.85rem;
            color: var(--bs-body-color);
            border: 1px solid var(--bs-border-color);
        }

        .btn-action {
            padding: 0.3rem 0.6rem;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 0.35rem;
        }
    </style>

    {{-- Header Sederhana & Rapi --}}
    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <span class="tag-volley">🏐 Manajemen Inventaris Voli</span>
            <h1 class="h4 fw-bold mb-1">Daftar Alat</h1>
            <p class="text-secondary small mb-0">Kelola data alat olahraga dan kategori dengan mudah.</p>
        </div>
        <div>
            <a href="{{ route('alat.create') }}" class="btn btn-volley-solid">
                + Tambah Alat
            </a>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="card card-clean p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-clean align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 6%;">No</th>
                        <th style="width: 30%;">Nama Alat</th>
                        <th style="width: 22%;">Kode Alat</th>
                        <th style="width: 22%;">Kategori</th>
                        <th class="text-end" style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse ($datal as $alats)
                        <tr>
                            <td class="text-secondary">{{ $no++ }}</td>
                            <td class="fw-semibold">{{ $alats->nama_alat }}</td>
                            <td><code class="inline-code">{{ $alats->kode_alat }}</code></td>
                            <td>
                                @php
                                    $namaKategori = '-';
                                    foreach ($kategori as $k) {
                                        if ($k->id_kategori == $alats->id_kategori) {
                                            $namaKategori = $k->nama_kategori;
                                            break;
                                        }
                                    }
                                @endphp
                                <span class="badge-kategori-clean">{{ $namaKategori }}</span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('alat.edit', ['alat' => $alats->id_alat]) }}" class="btn btn-outline-primary btn-action text-decoration-none">Edit</a>
                                    <form action="{{ route('alat.delete', ['id' => $alats->id_alat]) }}" method="POST" class="d-inline mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-action" onclick="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-secondary">
                                Belum ada data alat yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {!! $datal->links() !!}
    </div>
@endsection