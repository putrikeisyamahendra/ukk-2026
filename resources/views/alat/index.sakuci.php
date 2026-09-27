@extends('layouts.app')

@section('title', config('app.name') . ' -- Manajemen Alat Voli')

@section('content')

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