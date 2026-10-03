@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Peminjaman Alat')

@section('content')

<style>
html:has(.pm-page),
html:has(.pm-page) body {
    overflow: hidden;
}

.pm-page {
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

.pm-page::-webkit-scrollbar {
    display: none;
}

:root:has(#sidebarToggle:checked) .pm-page {
    left: 0;
}

.pm-page::before {
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

.pm-page::after {
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

.pm-content {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 80px 24px 40px;
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

.pm-title {
    color: var(--bs-heading-color);
    letter-spacing: -1px;
}

.text-volley {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.pm-desc {
    color: var(--bs-secondary-color);
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

.btn-delete-volley {
    color: #b38600;
    border: 1px solid #ffc107;
    background: transparent;
    border-radius: 9px;
    padding: 0.35rem 0.65rem;
    font-size: 0.8rem;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-delete-volley:hover {
    color: #102a43;
    background: linear-gradient(135deg, #ffc107, #ffda44);
    border-color: #ffc107;
}

.btn-action {
    padding: 0.35rem 0.65rem;
    border-radius: 9px;
    font-size: 0.8rem;
    font-weight: 600;
}

.pm-card {
    overflow: hidden;
    border-radius: 24px;
    background: color-mix(in srgb, var(--bs-body-bg) 90%, transparent);
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.pm-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.1rem 1.5rem;
    border-bottom: 1px solid var(--bs-border-color);
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.05), rgba(255, 193, 7, 0.04));
}

.pm-card-title {
    color: var(--bs-heading-color);
    font-weight: 700;
}

.pm-card-sub {
    color: var(--bs-secondary-color);
    font-size: 0.85rem;
}

.table-volley {
    --bs-table-bg: transparent;
    --bs-table-color: var(--bs-body-color);
    --bs-table-border-color: var(--bs-border-color);
    margin-bottom: 0;
}

.table-volley thead th {
    padding: 0.9rem 1rem;
    background: var(--bs-tertiary-bg);
    color: var(--bs-secondary-color);
    border-bottom: 1px solid var(--bs-border-color);
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    white-space: nowrap;
}

.table-volley tbody td {
    padding: 0.9rem 1rem;
    vertical-align: middle;
    color: var(--bs-body-color);
    border-bottom: 1px solid var(--bs-border-color);
}

.table-volley tbody tr:hover {
    background: rgba(13, 110, 253, 0.04);
}

.table-volley tbody tr:last-child td {
    border-bottom: none;
}

.unit-badge {
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    background: rgba(13, 110, 253, 0.08);
    border: 1px solid rgba(13, 110, 253, 0.15);
    color: #0d6efd;
    font-size: 0.8rem;
    font-weight: 600;
    white-space: nowrap;
}

.status-badge {
    display: inline-block;
    padding: 5px 11px;
    border-radius: 50px;
    font-size: 0.72rem;
    font-weight: 700;
    white-space: nowrap;
}

.st-pending { background: rgba(255, 193, 7, .18); color: #b38600; }
.st-setuju  { background: rgba(13, 202, 240, .18); color: #0a8aa5; }
.st-tolak   { background: rgba(220, 53, 69, .15); color: #dc3545; }
.st-pinjam  { background: rgba(13, 110, 253, .15); color: #0d6efd; }
.st-kembali { background: rgba(25, 135, 84, .15); color: #198754; }

.pm-alert {
    border: none;
    border-radius: 14px;
}

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
    bottom: 6%;
    right: 5%;
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
    .pm-page,
    :root:has(#sidebarToggle:checked) .pm-page {
        left: 0;
    }
}

@media (max-width: 768px) {
    .pm-content {
        padding: 80px 15px 30px;
    }

    .pm-card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
    }

    .volleyball {
        display: none;
    }
}
</style>

@php
    $namaUser = [];
    foreach ($users as $u) {
        $namaUser[$u->id] = $u->username;
    }

    $namaAlat = [];
    foreach ($alat as $a) {
        $namaAlat[$a->id_alat] = $a->nama_alat;
    }
@endphp

<section class="pm-page">

    <div class="volleyball"></div>

    <div class="pm-content">

        {{-- HEADER --}}

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">

            <div>
                <span class="badge rounded-pill badge-volley px-4 py-2 mb-3">
                    🏐 TRANSAKSI PEMINJAMAN
                </span>

                <div class="volley-line"></div>

                <h1 class="display-6 fw-bold mb-2 pm-title">
                    Daftar <span class="text-volley">Peminjaman Alat</span>
                </h1>

                <p class="pm-desc mb-0">
                    Kelola permohonan, status persetujuan, dan jadwal peminjaman alat.
                </p>
            </div>

            <a href="{{ route('peminjaman.create') }}" class="btn btn-volley btn-lg px-4">
                + Tambah Peminjaman
            </a>

        </div>


        {{-- ALERT --}}

        @if (session('success'))
            <div class="alert alert-success pm-alert mb-4">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger pm-alert mb-4">
                ⚠️ {{ session('error') }}
            </div>
        @endif


        {{-- TABEL --}}

        <div class="pm-card">

            <div class="pm-card-header">

                <div>
                    <div class="pm-card-title">📋 Data Peminjaman Alat</div>
                    <div class="pm-card-sub">Daftar transaksi peminjaman alat.</div>
                </div>

                <span class="pm-card-sub">Total: {{ count($data) }} data di halaman ini</span>

            </div>

            <div class="table-responsive">

                <table class="table table-volley align-middle">

                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Peminjam</th>
                            <th>Nama Alat</th>
                            <th>Jumlah</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @php $no = 1; @endphp

                        @forelse ($data as $peminjaman)

                            <tr>

                                <td class="text-center text-secondary">{{ $no++ }}</td>

                                <td class="fw-semibold">
                                    {{ $namaUser[$peminjaman->id_user] ?? 'User ID: ' . $peminjaman->id_user }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $namaAlat[$peminjaman->id_alat] ?? 'Alat ID: ' . $peminjaman->id_alat }}
                                </td>

                                <td>
                                    <span class="unit-badge">{{ $peminjaman->jumlah }} Unit</span>
                                </td>

                                <td class="text-secondary">{{ $peminjaman->tanggal_pinjam }}</td>

                                <td class="text-secondary">
                                    {{ $peminjaman->tanggal_kembali ?: '-' }}
                                </td>

                                <td>
                                    @if ($peminjaman->status == 'Pending')
                                        <span class="status-badge st-pending">⏳ Pending</span>
                                    @elseif ($peminjaman->status == 'Disetujui')
                                        <span class="status-badge st-setuju">✔ Disetujui</span>
                                    @elseif ($peminjaman->status == 'Ditolak')
                                        <span class="status-badge st-tolak">✖ Ditolak</span>
                                    @elseif ($peminjaman->status == 'Dipinjam')
                                        <span class="status-badge st-pinjam">📦 Dipinjam</span>
                                    @else
                                        <span class="status-badge st-kembali">✅ Dikembalikan</span>
                                    @endif
                                </td>

                                <td>
                                    @if (($peminjaman->denda ?? 0) > 0)
                                        <span class="text-danger fw-bold">
                                            Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-secondary">Rp 0</span>
                                    @endif
                                </td>

                                <td class="text-center">

                                    <div class="d-inline-flex flex-wrap align-items-center justify-content-center gap-1">

                                        {{-- SETUJUI / TOLAK (hanya saat Pending) --}}

                                        @if ($peminjaman->status == 'Pending')

                                            <form method="POST"
                                                  action="{{ route('peminjaman.setujui', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}"
                                                  class="d-inline m-0">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-action">
                                                    Setujui
                                                </button>
                                            </form>

                                            <form method="POST"
                                                  action="{{ route('peminjaman.tolak', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}"
                                                  class="d-inline m-0"
                                                  onsubmit="return confirm('Tolak pengajuan ini?')">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-outline-danger btn-action">
                                                    Tolak
                                                </button>
                                            </form>

                                        @endif

                                        {{-- EDIT --}}

                                        <a href="{{ route('peminjaman.edit', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}"
                                           class="btn btn-outline-primary btn-action text-decoration-none">
                                            Edit
                                        </a>

                                        {{-- HAPUS --}}

                                        <form action="{{ route('peminjaman.delete', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}"
                                              method="POST"
                                              class="d-inline m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-delete-volley"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="text-center py-5 text-secondary">
                                    <div style="font-size: 2.5rem;">🏐</div>
                                    <div class="fw-bold mb-1">Belum Ada Data Peminjaman</div>
                                    <div class="small">
                                        Data peminjaman yang diajukan akan muncul di sini.
                                    </div>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            @if (method_exists($data, 'hasPages') && $data->hasPages())
                <div class="p-3 d-flex justify-content-end">
                    {!! $data->links() !!}
                </div>
            @endif

        </div>

    </div>

</section>

@endsection