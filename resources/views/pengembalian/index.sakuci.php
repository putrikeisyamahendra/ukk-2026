@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Pengembalian Alat')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
.pengembalian-page { position: relative; overflow: hidden; }

.pengembalian-header {
    position: relative; min-height: 280px; display: flex; align-items: center;
    overflow: hidden; padding: 2rem; border-radius: 24px;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
    margin-bottom: 1.5rem;
}
.pengembalian-header::before {
    content: ""; position: absolute; width: 420px; height: 420px;
    background: rgba(13, 110, 253, 0.08); border-radius: 50%; top: -220px; right: -120px;
}
.pengembalian-header::after {
    content: ""; position: absolute; width: 330px; height: 330px;
    background: rgba(255, 193, 7, 0.10); border-radius: 50%; bottom: -190px; left: -100px;
}
.pengembalian-header-content { position: relative; z-index: 2; width: 100%; }

.badge-volley {
    display: inline-block; background: linear-gradient(135deg, #0d6efd, #084298);
    color: #fff; font-weight: 700; box-shadow: 0 6px 18px rgba(13, 110, 253, 0.25);
}
.pengembalian-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.text-volley {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.pengembalian-description { color: var(--bs-secondary-color); line-height: 1.8; }
.volley-line {
    width: 65px; height: 4px; margin-bottom: 20px; border-radius: 10px;
    background: linear-gradient(90deg, #0d6efd, #ffc107);
}

.btn-volley {
    border: none; border-radius: 12px; font-weight: 700; color: #fff;
    background: linear-gradient(135deg, #0d6efd, #084298);
    box-shadow: 0 7px 18px rgba(13, 110, 253, 0.22); transition: all 0.3s ease;
}
.btn-volley:hover { color: #fff; transform: translateY(-3px); box-shadow: 0 11px 25px rgba(13, 110, 253, 0.32); }

.btn-volley-yellow {
    border: none; border-radius: 12px; font-weight: 700; color: #102a43;
    background: linear-gradient(135deg, #ffc107, #ffda44);
    box-shadow: 0 7px 18px rgba(255, 193, 7, 0.22); transition: all 0.3s ease;
}
.btn-volley-yellow:hover { color: #102a43; transform: translateY(-3px); box-shadow: 0 11px 25px rgba(255, 193, 7, 0.32); }

.pengembalian-alert { border: none; border-radius: 14px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); }

/* SEARCH BAR */
.pengembalian-search {
    display: flex; align-items: center; gap: 10px; padding: 15px; margin-bottom: 1.5rem;
    border-radius: 20px; background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color); box-shadow: 0 12px 35px rgba(0, 0, 0, 0.06);
}
.pengembalian-search input {
    flex: 1; min-width: 0; height: 46px; padding: .7rem 1rem; border-radius: 12px;
    border: 1px solid var(--bs-border-color); background-color: var(--bs-body-bg);
    color: var(--bs-body-color); outline: none;
}
.pengembalian-search input::placeholder { color: var(--bs-secondary-color); }
.pengembalian-search input:focus { border-color: #0d6efd; box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.12); }
.pengembalian-search button { height: 46px; padding: 0 1.25rem; }

.pengembalian-card {
    overflow: hidden; border-radius: 24px;
    background: color-mix(in srgb, var(--bs-body-bg) 92%, transparent);
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.07); backdrop-filter: blur(10px);
}
.pengembalian-card-header {
    display: flex; justify-content: space-between; align-items: center;
    padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--bs-border-color);
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.05), rgba(255, 193, 7, 0.04));
}
.pengembalian-card-title { color: var(--bs-heading-color); font-weight: 700; font-size: 1rem; }
.pengembalian-card-title i { color: #0d6efd; }
.pengembalian-card-subtitle { color: var(--bs-secondary-color); font-size: 0.85rem; }
.total-badge {
    display: inline-flex; align-items: center; gap: 5px; background: var(--bs-body-bg);
    color: var(--bs-secondary-color); border: 1px solid var(--bs-border-color);
    padding: 6px 13px; border-radius: 50px; font-size: 0.8rem;
}

.table-volley { margin-bottom: 0; }
.table-volley thead th {
    padding: 1rem; background-color: var(--bs-tertiary-bg); color: var(--bs-secondary-color);
    border-bottom: 1px solid var(--bs-border-color); font-size: 0.78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.04em; white-space: nowrap;
}
.table-volley tbody td {
    padding: 1rem; vertical-align: middle; color: var(--bs-body-color);
    border-bottom: 1px solid var(--bs-border-color);
}
.table-volley tbody tr { transition: all 0.2s ease; }
.table-volley tbody tr:hover { background-color: rgba(13, 110, 253, 0.035); }
.table-volley tbody tr:last-child td { border-bottom: none; }

.id-pinjam {
    display: inline-block; padding: 0.35rem 0.65rem; border-radius: 8px;
    background-color: rgba(13, 110, 253, 0.08); border: 1px solid rgba(13, 110, 253, 0.12);
    color: #0d6efd; font-size: 0.8rem; font-weight: 700;
}

.status-badge {
    display: inline-flex; align-items: center; padding: 0.4rem 0.65rem; border-radius: 50px;
    font-size: 0.75rem; font-weight: 600; white-space: nowrap;
}
.condition-badge {
    display: inline-flex; align-items: center; padding: 0.4rem 0.65rem; border-radius: 8px;
    font-size: 0.75rem; font-weight: 600; white-space: nowrap;
}

.btn-action { padding: 0.4rem 0.7rem; border-radius: 9px; font-size: 0.8rem; font-weight: 600; transition: all 0.2s ease; }
.btn-action:hover { transform: translateY(-1px); }

.btn-delete-volley {
    color: #b02a37; border: 1px solid #dc3545; background: transparent; border-radius: 9px;
    padding: 0.4rem 0.7rem; font-size: 0.8rem; font-weight: 600; transition: all 0.2s ease;
}
.btn-delete-volley:hover {
    color: #fff; background: #dc3545; border-color: #dc3545;
    transform: translateY(-1px); box-shadow: 0 5px 12px rgba(220, 53, 69, 0.25);
}

/* BOLA VOLI (tanpa garis hitam) */
.volleyball {
    position: absolute; width: 105px; height: 105px; border-radius: 50%;
    background: var(--bs-tertiary-bg); border: none;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15); z-index: 1; opacity: 0.95;
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
    bottom: 8%; right: 2%; width: 75px; height: 75px; opacity: 0.65;
    animation: floating 5s ease-in-out infinite reverse;
}
.ball-two::before { width: 60px; height: 30px; border-width: 4px; }
.ball-two::after { width: 50px; height: 25px; border-width: 4px; }

@keyframes floating {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(8deg); }
}

.empty-icon {
    width: 70px; height: 70px; display: flex; align-items: center; justify-content: center;
    background: var(--bs-body-bg); border: 1px solid var(--bs-border-color);
    border-radius: 50%; margin-bottom: 12px; color: #0d6efd;
}

.pagination-wrapper {
    padding: 1rem 1.25rem; border-top: 1px solid var(--bs-border-color);
    display: flex; justify-content: flex-end;
}

/* Mode gelap */
[data-bs-theme="dark"] .pengembalian-header,
:root:has(#themeToggle:checked) .pengembalian-header {
    background: linear-gradient(135deg, var(--bs-body-bg), #172033);
}
[data-bs-theme="dark"] .pengembalian-header::before,
:root:has(#themeToggle:checked) .pengembalian-header::before { background: rgba(13, 110, 253, 0.12); }
[data-bs-theme="dark"] .pengembalian-header::after,
:root:has(#themeToggle:checked) .pengembalian-header::after { background: rgba(255, 193, 7, 0.08); }
[data-bs-theme="dark"] .pengembalian-card,
:root:has(#themeToggle:checked) .pengembalian-card { background: rgba(255, 255, 255, 0.04); }
[data-bs-theme="dark"] .table-volley tbody tr:hover,
:root:has(#themeToggle:checked) .table-volley tbody tr:hover { background-color: rgba(13, 110, 253, 0.07); }

@media (max-width: 768px) {
    .pengembalian-header { min-height: 330px; padding: 1.5rem; }
    .pengembalian-header .row { text-align: center; }
    .pengembalian-header .volley-line { margin-left: auto; margin-right: auto; }
    .pengembalian-header .btn-volley { width: 100%; }
    .pengembalian-card-header { flex-direction: column; align-items: flex-start; gap: 8px; }
    .pengembalian-search { flex-direction: column; }
    .pengembalian-search input, .pengembalian-search button { width: 100%; }
    .volleyball { width: 65px; height: 65px; }
    .volleyball::before { width: 52px; height: 25px; border-width: 4px; }
    .volleyball::after { width: 45px; height: 20px; border-width: 4px; }
    .ball-one { top: 7%; right: 4%; }
    .ball-two { display: none; }
    .table-volley thead th, .table-volley tbody td { padding: 0.75rem; }
    .pagination-wrapper { justify-content: center; }
}
</style>

<div class="container py-3 py-lg-4 pengembalian-page">

    {{-- HEADER --}}
    <section class="pengembalian-header">

        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>

        <div class="pengembalian-header-content">

            <span class="badge rounded-pill badge-volley px-4 py-2 mb-4">
                🏐 TRANSAKSI PENGEMBALIAN
            </span>

            <div class="volley-line"></div>

            <div class="row align-items-center">

                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-3 pengembalian-title">
                        Daftar <span class="text-volley">Pengembalian Alat</span>
                    </h1>

                    <p class="lead pengembalian-description mb-0" style="max-width: 650px;">
                        Kelola riwayat pengembalian alat, keterlambatan, denda,
                        dan kondisi barang dengan mudah dan terorganisir.
                    </p>
                </div>

                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <a href="{{ route('pengembalian.create') }}"
                       class="btn btn-volley btn-lg px-4 d-inline-flex align-items-center gap-2">
                        <i class="bi bi-plus-circle-fill"></i>
                        Tambah Pengembalian
                    </a>
                </div>

            </div>

        </div>

    </section>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show pengembalian-alert mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <div class="small fw-medium">{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger pengembalian-alert mb-4">⚠️ {{ session('error') }}</div>
    @endif

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('pengembalian.index') }}" class="pengembalian-search">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari ID pinjam, kondisi barang, atau catatan...">
        <button type="submit" class="btn btn-volley">🔍 Cari</button>
    </form>

    {{-- TABEL --}}
    <div class="pengembalian-card">

        <div class="pengembalian-card-header">
            <div>
                <div class="pengembalian-card-title">
                    <i class="bi bi-journal-check me-2"></i>
                    Data Pengembalian Alat
                </div>
                <div class="pengembalian-card-subtitle">
                    Daftar riwayat pengembalian alat olahraga voli yang telah tercatat.
                </div>
            </div>

            <span class="total-badge">
                <i class="bi bi-database me-1"></i>
                Total: {{ count($data) }} Data
            </span>
        </div>

        <div class="table-responsive">

            <table class="table table-volley align-middle">

                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">NO</th>
                        <th>ID PINJAM</th>
                        <th>TGL PENGEMBALIAN</th>
                        <th>KETERLAMBATAN</th>
                        <th>DENDA</th>
                        <th>KONDISI BARANG</th>
                        <th>CATATAN</th>
                        <th class="text-center" style="width: 180px;">AKSI</th>
                    </tr>
                </thead>

                <tbody>

                    @php $no = 1; @endphp

                    @forelse ($data as $pengembalian)

                        <tr>

                            <td class="text-center text-secondary">{{ $no++ }}</td>

                            <td>
                                <code class="id-pinjam">
                                    <i class="bi bi-hash me-1"></i>{{ $pengembalian->id_peminjaman }}
                                </code>
                            </td>

                            <td>
                                <span class="text-secondary">
                                    <i class="bi bi-calendar-check me-1"></i>{{ $pengembalian->tanggal_pengembalian }}
                                </span>
                            </td>

                            <td>
                                @if ($pengembalian->terlambat_hari > 0)
                                    <span class="status-badge bg-danger-subtle text-danger border border-danger border-opacity-25">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                        {{ $pengembalian->terlambat_hari }} Hari
                                    </span>
                                @else
                                    <span class="status-badge bg-success-subtle text-success border border-success border-opacity-25">
                                        <i class="bi bi-check-circle-fill me-1"></i>
                                        Tepat Waktu
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if (($pengembalian->denda ?? 0) > 0)
                                    <span class="text-danger fw-bold">
                                        Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-secondary">Rp 0</span>
                                @endif
                            </td>

                            <td>
                                @php
                                    $kondisi = strtolower($pengembalian->kondisi_barang ?? 'baik');
                                @endphp

                                @if (str_contains($kondisi, 'baik'))
                                    <span class="condition-badge bg-success-subtle text-success border border-success border-opacity-25">
                                        <i class="bi bi-check-circle-fill me-1"></i>
                                        {{ $pengembalian->kondisi_barang ?? 'Baik' }}
                                    </span>
                                @elseif (str_contains($kondisi, 'rusak'))
                                    <span class="condition-badge bg-warning-subtle text-warning border border-warning border-opacity-25">
                                        <i class="bi bi-tools me-1"></i>
                                        {{ $pengembalian->kondisi_barang }}
                                    </span>
                                @else
                                    <span class="condition-badge bg-body-tertiary text-body border">
                                        {{ $pengembalian->kondisi_barang ?? 'Baik' }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                <span class="text-secondary text-truncate d-inline-block"
                                      style="max-width: 180px;"
                                      title="{{ $pengembalian->catatan ?? '' }}">
                                    {{ $pengembalian->catatan ?? '-' }}
                                </span>
                            </td>

                            <td class="text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-1">

                                    <a href="{{ route('pengembalian.edit', ['id_pengembalian' => $pengembalian->id_pengembalian]) }}"
                                       class="btn btn-outline-primary btn-action text-decoration-none d-inline-flex align-items-center gap-1"
                                       title="Edit Pengembalian">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('pengembalian.delete', ['id_pengembalian' => $pengembalian->id_pengembalian]) }}"
                                          method="POST" class="d-inline mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-delete-volley d-inline-flex align-items-center gap-1"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data pengembalian ini?')"
                                                title="Hapus Data">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center py-5 text-secondary">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="empty-icon">
                                        <i class="bi bi-arrow-return-left fs-2 opacity-75"></i>
                                    </div>
                                    @if (request('search'))
                                        <div class="fw-semibold mb-1 text-body">Data tidak ditemukan</div>
                                        <div>Tidak ada pengembalian dengan kata kunci <strong>"{{ request('search') }}"</strong>.</div>
                                    @else
                                        <div class="fw-semibold mb-1 text-body">Belum Ada Data Pengembalian</div>
                                        <div>Data pengembalian alat yang ditambahkan akan muncul di sini.</div>
                                    @endif
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if (method_exists($data, 'hasPages') && $data->hasPages())
            <div class="pagination-wrapper">
                {!! $data->links() !!}
            </div>
        @endif

    </div>

</div>

@endsection
