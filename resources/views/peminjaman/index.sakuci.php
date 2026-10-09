@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Peminjaman Alat')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
.peminjaman-page { position: relative; overflow: hidden; }

.peminjaman-header {
    position: relative; min-height: 280px; display: flex; align-items: center;
    overflow: hidden; padding: 2rem; border-radius: 24px;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
    margin-bottom: 1.5rem;
}
.peminjaman-header::before {
    content: ""; position: absolute; width: 420px; height: 420px;
    background: rgba(13, 110, 253, 0.08); border-radius: 50%; top: -220px; right: -120px;
}
.peminjaman-header::after {
    content: ""; position: absolute; width: 330px; height: 330px;
    background: rgba(255, 193, 7, 0.10); border-radius: 50%; bottom: -190px; left: -100px;
}
.peminjaman-header-content { position: relative; z-index: 2; width: 100%; }

.badge-volley {
    display: inline-block; background: linear-gradient(135deg, #0d6efd, #084298);
    color: #fff; font-weight: 700; box-shadow: 0 6px 18px rgba(13, 110, 253, 0.25);
}
.peminjaman-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.text-volley {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.peminjaman-description { color: var(--bs-secondary-color); line-height: 1.8; }
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

.peminjaman-alert { border: none; border-radius: 14px; box-shadow: 0 5px 18px rgba(0, 0, 0, 0.06); }

.peminjaman-card {
    overflow: hidden; border-radius: 24px;
    background: color-mix(in srgb, var(--bs-body-bg) 92%, transparent);
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.07); backdrop-filter: blur(10px);
}
.peminjaman-card-header {
    display: flex; justify-content: space-between; align-items: center;
    padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--bs-border-color);
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.05), rgba(255, 193, 7, 0.04));
}
.peminjaman-card-title { color: var(--bs-heading-color); font-weight: 700; font-size: 1rem; }
.peminjaman-card-title i { color: #0d6efd; }
.peminjaman-card-subtitle { color: var(--bs-secondary-color); font-size: 0.85rem; }
.total-badge {
    display: inline-flex; align-items: center; gap: 5px; padding: 0.4rem 0.75rem;
    border-radius: 50px; background: var(--bs-body-bg); border: 1px solid var(--bs-border-color);
    color: var(--bs-secondary-color); font-size: 0.8rem; white-space: nowrap;
}

.table-volley {
    --bs-table-bg: transparent; --bs-table-color: var(--bs-body-color);
    --bs-table-border-color: var(--bs-border-color); margin-bottom: 0;
}
.table-volley thead th {
    padding: 1rem; background-color: var(--bs-tertiary-bg); color: var(--bs-secondary-color);
    border-bottom: 1px solid var(--bs-border-color); font-size: 0.78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.04em; white-space: nowrap;
}
.table-volley tbody td {
    padding: 1rem; vertical-align: middle; color: var(--bs-body-color);
    border-bottom: 1px solid var(--bs-border-color);
}
.table-volley tbody tr:hover { background-color: rgba(13, 110, 253, 0.035); }
.table-volley tbody tr:last-child td { border-bottom: none; }

.unit-badge {
    display: inline-block; padding: 0.35rem 0.65rem; border-radius: 8px;
    background-color: rgba(13, 110, 253, 0.08); border: 1px solid rgba(13, 110, 253, 0.12);
    color: #0d6efd; font-size: 0.8rem; font-weight: 600;
}
.status-badge {
    display: inline-flex; align-items: center; padding: 6px 10px; border-radius: 50px;
    font-size: 0.72rem; font-weight: 600; white-space: nowrap;
}

.st-pending { background: rgba(255, 193, 7, .18);  color: #b38600; }
.st-setuju  { background: rgba(13, 202, 240, .18); color: #0a8aa5; }
.st-tolak   { background: rgba(220, 53, 69, .15);  color: #dc3545; }
.st-pinjam  { background: rgba(13, 110, 253, .15); color: #0d6efd; }
.st-kembali { background: rgba(25, 135, 84, .15);  color: #198754; }

.btn-action { padding: 0.4rem 0.7rem; border-radius: 9px; font-size: 0.8rem; font-weight: 600; transition: all 0.2s ease; }
.btn-action:hover { transform: translateY(-1px); }
.btn-delete-volley {
    color: #b38600; border: 1px solid #ffc107; background: transparent; border-radius: 9px;
    padding: 0.4rem 0.7rem; font-size: 0.8rem; font-weight: 600; transition: all 0.2s ease;
}

.btn-delete-volley:hover {
    color: #102a43; background: linear-gradient(135deg, #ffc107, #ffda44);
    border-color: #ffc107; transform: translateY(-1px);
}

.empty-icon {
    width: 65px; height: 65px; display: flex; align-items: center; justify-content: center;
    background: var(--bs-body-bg); border: 1px solid var(--bs-border-color);
    border-radius: 50%; margin-bottom: 10px; color: var(--bs-secondary-color);
}

/* Bola voli (ganti 'border: 4px solid ...' jadi 'border: none' kalau tidak mau ada garis) */
.volleyball {
    position: absolute; width: 105px; height: 105px; border-radius: 50%;
    background: var(--bs-body-bg); border: 4px solid var(--bs-heading-color);
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

/* Mode gelap (ikut tombol tema) */
:root:has(#themeToggle:checked) .peminjaman-header {
    background: linear-gradient(135deg, var(--bs-body-bg), #172033);
}
:root:has(#themeToggle:checked) .peminjaman-header::before { background: rgba(13, 110, 253, 0.12); }
:root:has(#themeToggle:checked) .peminjaman-header::after { background: rgba(255, 193, 7, 0.08); }
:root:has(#themeToggle:checked) .peminjaman-card { background: rgba(255, 255, 255, 0.04); }
:root:has(#themeToggle:checked) .table-volley tbody tr:hover { background-color: rgba(13, 110, 253, 0.07); }

@media (max-width: 768px) {
    .peminjaman-header { min-height: 330px; padding: 1.5rem; }
    .peminjaman-header .row { text-align: center; }
    .peminjaman-header .volley-line { margin-left: auto; margin-right: auto; }
    .peminjaman-header .btn-volley { width: 100%; }
    .peminjaman-card-header { flex-direction: column; align-items: flex-start; gap: 8px; }
    .volleyball { width: 65px; height: 65px; }
    .volleyball::before { width: 52px; height: 25px; border-width: 4px; }
    .volleyball::after { width: 45px; height: 20px; border-width: 4px; }
    .ball-one { top: 7%; right: 4%; }
    .ball-two { display: none; }
    .table-volley thead th, .table-volley tbody td { padding: 0.75rem; }
}
</style>

@php
    $namaUser = [];
    foreach ($users as $u) { $namaUser[$u->id] = $u->username; }

    $namaAlat = [];
    foreach ($alat as $a) { $namaAlat[$a->id_alat] = $a->nama_alat; }
@endphp

<div class="container py-3 py-lg-4 peminjaman-page">

    {{-- HEADER --}}
    <section class="peminjaman-header">

        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>

        <div class="peminjaman-header-content">

            <span class="badge rounded-pill badge-volley px-4 py-2 mb-4">
                🏐 TRANSAKSI PEMINJAMAN
            </span>

            <div class="volley-line"></div>

            <div class="row align-items-center">

                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-3 peminjaman-title">
                        Daftar <span class="text-volley">Peminjaman Alat</span>
                    </h1>

                    <p class="lead peminjaman-description mb-0" style="max-width: 650px;">
                        Kelola riwayat permohonan, status persetujuan,
                        dan jadwal peminjaman alat sarpras.
                    </p>
                </div>

                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <a href="{{ route('peminjaman.create') }}" class="btn btn-volley btn-lg px-4">
                        <i class="bi bi-plus-circle-fill me-2"></i>
                        Tambah Peminjaman
                    </a>
                </div>

            </div>

        </div>

    </section>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success peminjaman-alert mb-4">✅ {{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger peminjaman-alert mb-4">⚠️ {{ session('error') }}</div>
    @endif

    {{-- TABEL --}}
    <div class="peminjaman-card">

        <div class="peminjaman-card-header">
            <div>
                <div class="peminjaman-card-title">
                    <i class="bi bi-list-check me-2"></i>
                    Data Peminjaman Alat
                </div>
                <div class="peminjaman-card-subtitle">
                    Daftar transaksi peminjaman alat yang tersedia.
                </div>
            </div>

            <span class="total-badge">
                <i class="bi bi-database"></i>
                Total: {{ count($data) }} Data
            </span>
        </div>

        <div class="table-responsive">

            <table class="table table-volley align-middle">

                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th>Peminjam</th>
                        <th>Nama Alat</th>
                        <th>Jumlah</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th class="text-center" style="width: 230px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @php $no = 1; @endphp

                    @forelse ($data as $peminjaman)

                        <tr>

                            <td class="text-center text-body-secondary fw-medium">{{ $no++ }}</td>

                            <td>
                                <span class="fw-semibold">
                                    {{ $namaUser[$peminjaman->id_user] ?? 'User ID: ' . $peminjaman->id_user }}
                                </span>
                            </td>

                            <td>
                                <span class="fw-semibold">
                                    {{ $namaAlat[$peminjaman->id_alat] ?? 'Alat ID: ' . $peminjaman->id_alat }}
                                </span>
                            </td>

                            <td><span class="unit-badge">{{ $peminjaman->jumlah }} Unit</span></td>

                            <td class="text-body-secondary">
                                <i class="bi bi-calendar-event me-1"></i>{{ $peminjaman->tanggal_pinjam }}
                            </td>

                            <td class="text-body-secondary">
                                @if ($peminjaman->tanggal_kembali)
                                    <i class="bi bi-calendar-check me-1"></i>{{ $peminjaman->tanggal_kembali }}
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                @if ($peminjaman->status == 'Pending')
    <span class="status-badge st-pending"><i class="bi bi-hourglass-split me-1"></i>Pending</span>
@elseif ($peminjaman->status == 'Disetujui')
    <span class="status-badge st-setuju"><i class="bi bi-check2-circle me-1"></i>Disetujui</span>
@elseif ($peminjaman->status == 'Ditolak')
    <span class="status-badge st-tolak"><i class="bi bi-x-circle me-1"></i>Ditolak</span>
@elseif ($peminjaman->status == 'Dipinjam')
    <span class="status-badge st-pinjam"><i class="bi bi-box-arrow-up-right me-1"></i>Dipinjam</span>
@else
    <span class="status-badge st-kembali"><i class="bi bi-check-circle-fill me-1"></i>Dikembalikan</span>
@endif
                            </td>

                            <td class="text-center">

                                <div class="d-inline-flex flex-wrap align-items-center justify-content-center gap-1">

                                    @if ($peminjaman->status == 'Pending')

                                        <form method="POST"
                                              action="{{ route('peminjaman.setujui', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}"
                                              class="d-inline m-0">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-action">Setujui</button>
                                        </form>

                                        <form method="POST"
                                              action="{{ route('peminjaman.tolak', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}"
                                              class="d-inline m-0"
                                              onsubmit="return confirm('Tolak pengajuan ini?')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-outline-danger btn-action">Tolak</button>
                                        </form>

                                    @endif

                                    <a href="{{ route('peminjaman.edit', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}"
                                       class="btn btn-outline-primary btn-action d-inline-flex align-items-center gap-1"
                                       title="Edit Peminjaman">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('peminjaman.delete', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}"
                                          method="POST" class="d-inline m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-delete-volley d-inline-flex align-items-center gap-1"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')"
                                                title="Hapus Data">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="text-center py-5 text-body-secondary">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="empty-icon"><i class="bi bi-inbox fs-2 opacity-50"></i></div>
                                    <h6 class="fw-bold mb-1 text-body">Belum Ada Data Peminjaman</h6>
                                    <span class="small">Data peminjaman alat yang diajukan akan muncul di sini.</span>
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

@endsection