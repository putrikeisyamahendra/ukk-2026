@extends('layouts.app')

@section('title', 'Persetujuan Peminjaman')

@section('content')

<style>
html:has(.ps-page), html:has(.ps-page) body { overflow: hidden; }

.ps-page {
    position: fixed; top: 0; right: 0; bottom: 0; left: 260px; z-index: 1;
    overflow-y: auto; scrollbar-width: none;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    color: var(--bs-body-color);
    transition: left .3s ease;
}
.ps-page::-webkit-scrollbar { display: none; }
:root:has(#sidebarToggle:checked) .ps-page { left: 0; }

.ps-content { max-width: 1000px; margin: 0 auto; padding: 80px 24px 40px; }
.ps-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.ps-title span {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.ps-card {
    overflow: hidden; border-radius: 20px;
    background: color-mix(in srgb, var(--bs-body-bg) 90%, transparent);
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0,0,0,.08);
}
.ps-table {
    --bs-table-bg: transparent;
    --bs-table-color: var(--bs-body-color);
    --bs-table-border-color: var(--bs-border-color);
    margin: 0;
}
.ps-table thead th {
    background: var(--bs-tertiary-bg); color: var(--bs-secondary-color);
    font-size: .75rem; text-transform: uppercase; letter-spacing: .04em; padding: .9rem 1rem;
}
.ps-table td { padding: .9rem 1rem; vertical-align: middle; }

@media (max-width: 991px) { .ps-page, :root:has(#sidebarToggle:checked) .ps-page { left: 0; } }
@media (max-width: 768px) { .ps-content { padding: 80px 15px 30px; } }
</style>

@php
    $namaUser = [];
    foreach ($users as $u) { $namaUser[$u->id] = $u->username; }

    $namaAlat = [];
    foreach ($alat as $a) { $namaAlat[$a->id_alat] = $a->nama_alat; }
@endphp

<section class="ps-page">
    <div class="ps-content">

        <h1 class="display-6 fw-bold mb-1 ps-title">
            Persetujuan <span>Peminjaman</span>
        </h1>
        <p class="text-secondary mb-4">Pengajuan yang menunggu keputusan petugas.</p>

        @if (session('success'))
            <div class="alert alert-success" style="border-radius: 14px;">✅ {{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" style="border-radius: 14px;">⚠️ {{ session('error') }}</div>
        @endif

        <div class="ps-card">
            <div class="table-responsive">
                <table class="table ps-table">
                    <thead>
                        <tr>
                            <th>Peminjam</th>
                            <th>Alat</th>
                            <th>Jumlah</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $p)
                            <tr>
                                <td class="fw-semibold">{{ $namaUser[$p->id_user] ?? 'User ' . $p->id_user }}</td>
                                <td>{{ $namaAlat[$p->id_alat] ?? 'Alat ' . $p->id_alat }}</td>
                                <td>{{ $p->jumlah }} Unit</td>
                                <td class="text-secondary">{{ $p->tanggal_pinjam }}</td>
                                <td class="text-secondary">{{ $p->tanggal_kembali ?: '-' }}</td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-1">
                                        <form method="POST"
                                              action="{{ route('petugas.setujui', ['id_peminjaman' => $p->id_peminjaman]) }}">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-success btn-sm">Setujui</button>
                                        </form>
                                        <form method="POST"
                                              action="{{ route('petugas.tolak', ['id_peminjaman' => $p->id_peminjaman]) }}"
                                              onsubmit="return confirm('Tolak pengajuan ini?')">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-outline-danger btn-sm">Tolak</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-secondary">
                                    <div style="font-size: 2.5rem;">🏐</div>
                                    Tidak ada pengajuan yang menunggu.
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