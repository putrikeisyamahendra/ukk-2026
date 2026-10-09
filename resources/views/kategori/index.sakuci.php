@extends('layouts.app')

@section('title', config('app.name') . ' -- Manajemen Kategori Voli')

@section('content')

<style>
.kategori-page { position: relative; overflow: hidden; }

.kategori-header {
    position: relative; min-height: 280px; display: flex; align-items: center;
    overflow: hidden; padding: 2rem; border-radius: 24px;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0,0,0,.08);
    margin-bottom: 1.5rem;
}
.kategori-header::before {
    content: ""; position: absolute; width: 420px; height: 420px;
    background: rgba(13,110,253,.08); border-radius: 50%; top: -220px; right: -120px;
}
.kategori-header::after {
    content: ""; position: absolute; width: 330px; height: 330px;
    background: rgba(255,193,7,.10); border-radius: 50%; bottom: -190px; left: -100px;
}
.kategori-header-content { position: relative; z-index: 2; width: 100%; }

.badge-volley {
    display: inline-block; background: linear-gradient(135deg, #0d6efd, #084298);
    color: #fff; font-weight: 700; box-shadow: 0 6px 18px rgba(13,110,253,.25);
}
.kategori-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.text-volley {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.kategori-description { color: var(--bs-secondary-color); line-height: 1.8; }
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

/* Search: warna sama dengan card lain */
.kategori-search {
    display: flex; align-items: center; gap: 10px; padding: 15px; margin-bottom: 1.5rem;
    border-radius: 20px; background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0,0,0,.06);
}
.kategori-search input {
    flex: 1; min-width: 0; height: 46px; padding: .7rem 1rem; border-radius: 12px;
    border: 1px solid var(--bs-border-color); background-color: var(--bs-body-bg);
    color: var(--bs-body-color); outline: none; transition: all .2s ease;
}
.kategori-search input::placeholder { color: var(--bs-secondary-color); }
.kategori-search input:focus { border-color: #0d6efd; box-shadow: 0 0 0 3px rgba(13,110,253,.12); }
.kategori-search button { height: 46px; padding-left: 1.25rem; padding-right: 1.25rem; }

/* Card tabel: warna solid, tidak ikut latar */
.kategori-card {
    overflow: hidden; border-radius: 24px; background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color); box-shadow: 0 12px 35px rgba(0,0,0,.07);
}
.kategori-card-header {
    display: flex; justify-content: space-between; align-items: center;
    padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--bs-border-color);
    background: linear-gradient(135deg, rgba(13,110,253,.05), rgba(255,193,7,.04));
}
.kategori-card-title { color: var(--bs-heading-color); font-weight: 700; font-size: 1rem; }
.kategori-card-subtitle { color: var(--bs-secondary-color); font-size: .85rem; }

.table-volley {
    --bs-table-bg: transparent; --bs-table-color: var(--bs-body-color);
    --bs-table-border-color: var(--bs-border-color); margin-bottom: 0;
}
.table-volley thead th {
    padding: 1rem; background-color: var(--bs-tertiary-bg); color: var(--bs-secondary-color);
    border-bottom: 1px solid var(--bs-border-color); font-size: .78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: .04em; white-space: nowrap;
}
.table-volley tbody td {
    padding: 1rem; vertical-align: middle; color: var(--bs-body-color);
    border-bottom: 1px solid var(--bs-border-color);
}
.table-volley tbody tr:hover { background-color: rgba(13,110,253,.035); }
.table-volley tbody tr:last-child td { border-bottom: none; }

.kategori-code {
    display: inline-block; padding: .35rem .65rem; border-radius: 8px;
    background-color: rgba(13,110,253,.08); border: 1px solid rgba(13,110,253,.12);
    color: #0d6efd; font-size: .8rem;
}

.btn-action { padding: .4rem .7rem; border-radius: 9px; font-size: .8rem; font-weight: 600; transition: all .2s ease; }
.btn-action:hover { transform: translateY(-1px); }
.btn-delete-volley {
    color: #b38600; border: 1px solid #ffc107; background: transparent; border-radius: 9px;
    padding: .4rem .7rem; font-size: .8rem; font-weight: 600; transition: all .2s ease;
}
.btn-delete-volley:hover {
    color: #102a43; background: linear-gradient(135deg, #ffc107, #ffda44);
    border-color: #ffc107; transform: translateY(-1px);
}

/* Bola voli tanpa garis putih */
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

/* Mode gelap ikut tombol tema */
:root:has(#themeToggle:checked) .kategori-header { background: linear-gradient(135deg, var(--bs-body-bg), #172033); }
:root:has(#themeToggle:checked) .kategori-header::before { background: rgba(13,110,253,.12); }
:root:has(#themeToggle:checked) .kategori-header::after { background: rgba(255,193,7,.08); }
:root:has(#themeToggle:checked) .table-volley tbody tr:hover { background-color: rgba(13,110,253,.07); }

@media (max-width: 768px) {
    .kategori-header { min-height: 330px; padding: 1.5rem; }
    .kategori-header .row { text-align: center; }
    .kategori-header .volley-line { margin-left: auto; margin-right: auto; }
    .kategori-header .btn-volley { width: 100%; }
    .kategori-search { flex-direction: column; }
    .kategori-search input, .kategori-search button { width: 100%; }
    .kategori-card-header { flex-direction: column; align-items: flex-start; gap: 5px; }
    .volleyball { width: 65px; height: 65px; }
    .volleyball::before { width: 52px; height: 25px; border-width: 4px; }
    .volleyball::after { width: 45px; height: 20px; border-width: 4px; }
    .ball-one { top: 7%; right: 4%; }
    .ball-two { display: none; }
    .table-volley thead th, .table-volley tbody td { padding: .75rem; }
}
</style>

<div class="container py-3 py-lg-4 kategori-page">

    {{-- HEADER --}}
    <section class="kategori-header">

        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>

        <div class="kategori-header-content">

            <span class="badge rounded-pill badge-volley px-4 py-2 mb-4">
                🏐 MANAJEMEN INVENTARIS VOLI
            </span>

            <div class="volley-line"></div>

            <div class="row align-items-center">

                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-3 kategori-title">
                        Daftar <span class="text-volley">Kategori</span>
                    </h1>

                    <p class="lead kategori-description mb-0" style="max-width: 650px;">
                        Kelola kategori alat olahraga voli
                        dengan mudah, cepat, dan terorganisir.
                    </p>
                </div>

                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <a href="{{ route('kategori.create') }}" class="btn btn-volley btn-lg px-4">
                        + Tambah Kategori
                    </a>
                </div>

            </div>

        </div>

    </section>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('kategori.index') }}" class="kategori-search">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kategori...">
        <button type="submit" class="btn btn-volley">🔍 Cari</button>
    </form>

    {{-- TABEL --}}
    <div class="kategori-card">

        <div class="kategori-card-header">
            <div>
                <div class="kategori-card-title">📋 Data Kategori</div>
                <div class="kategori-card-subtitle">Daftar kategori alat olahraga voli yang tersedia.</div>
            </div>

            @if (request('search'))
                <div class="kategori-card-subtitle">
                    Hasil pencarian: <strong>"{{ request('search') }}"</strong>
                </div>
            @endif
        </div>

        <div class="table-responsive">

            <table class="table table-volley align-middle">

                <thead>
                    <tr>
                        <th style="width: 7%;">NO</th>
                        <th style="width: 22%;">KODE KATEGORI</th>
                        <th style="width: 25%;">NAMA KATEGORI</th>
                        <th style="width: 26%;">KETERANGAN</th>
                        <th class="text-end" style="width: 20%;">AKSI</th>
                    </tr>
                </thead>

                <tbody>

                    @php $no = 1; @endphp

                    @forelse ($data as $item)

                        <tr>
                            <td class="text-secondary">{{ $no++ }}</td>

                            <td><code class="kategori-code">{{ $item->kode_kategori }}</code></td>

                            <td class="fw-semibold">{{ $item->nama_kategori }}</td>

                            <td class="text-secondary">{{ $item->keterangan ?? '-' }}</td>

                            <td class="text-end">
                                <div class="d-inline-flex gap-1">

                                    <a href="{{ route('kategori.edit', ['id_kategori' => $item->id_kategori]) }}"
                                       class="btn btn-outline-primary btn-action text-decoration-none">
                                        Edit
                                    </a>

                                    <form action="{{ route('kategori.destroy', ['id_kategori' => $item->id_kategori]) }}"
                                          method="POST" class="d-inline mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-delete-volley"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center py-5 text-secondary">
                                <div class="mb-3" style="font-size: 2.5rem;">🏐</div>

                                @if (request('search'))
                                    <div class="fw-semibold mb-1">Kategori tidak ditemukan</div>
                                    <div>Tidak ada kategori dengan nama <strong>"{{ request('search') }}"</strong>.</div>
                                @else
                                    <div class="fw-semibold mb-1">Belum ada data kategori</div>
                                    <div>Silakan tambahkan kategori terlebih dahulu.</div>
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
        {!! $data->links() !!}
    </div>

</div>

@endsection