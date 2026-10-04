@extends('layouts.app')

@section('title', 'Log Aktivitas')

@section('content')

<style>
html:has(.lg-page), html:has(.lg-page) body { overflow: hidden; }

.lg-page {
    position: fixed; top: 0; right: 0; bottom: 0; left: 260px; z-index: 1;
    overflow-y: auto; scrollbar-width: none;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    color: var(--bs-body-color);
    transition: left .3s ease;
}
.lg-page::-webkit-scrollbar { display: none; }
:root:has(#sidebarToggle:checked) .lg-page { left: 0; }

.lg-content { max-width: 1000px; margin: 0 auto; padding: 80px 24px 40px; }
.lg-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.lg-title span {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.lg-card {
    overflow: hidden; border-radius: 20px;
    background: color-mix(in srgb, var(--bs-body-bg) 90%, transparent);
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0,0,0,.08);
}
.lg-table {
    --bs-table-bg: transparent;
    --bs-table-color: var(--bs-body-color);
    --bs-table-border-color: var(--bs-border-color);
    margin: 0;
}
.lg-table thead th {
    background: var(--bs-tertiary-bg); color: var(--bs-secondary-color);
    font-size: .75rem; text-transform: uppercase; letter-spacing: .04em; padding: .9rem 1rem;
}
.lg-table td { padding: .8rem 1rem; vertical-align: middle; }

@media (max-width: 991px) { .lg-page, :root:has(#sidebarToggle:checked) .lg-page { left: 0; } }
@media (max-width: 768px) { .lg-content { padding: 80px 15px 30px; } }
</style>

@php
    $namaUser = [];
    foreach ($users as $u) { $namaUser[$u->id] = $u->username; }
@endphp

<section class="lg-page">
    <div class="lg-content">

        <h1 class="display-6 fw-bold mb-1 lg-title">Log <span>Aktivitas</span></h1>
        <p class="text-secondary mb-4">Riwayat aktivitas pengguna di sistem.</p>

        <div class="lg-card">
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
                            <tr>
                                <td class="text-secondary">{{ $l->created_at }}</td>
                                <td class="fw-semibold">{{ $l->id_user ? ($namaUser[$l->id_user] ?? 'User ' . $l->id_user) : '-' }}</td>
                                <td>{{ $l->aktivitas }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-secondary">
                                    Belum ada aktivitas tercatat.
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