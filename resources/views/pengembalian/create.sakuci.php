```blade
@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambah Pengembalian')

@section('content')

<style>
    /* ================================
       BACKGROUND
    ================================= */

    .tambah-pengembalian-wrapper {
        position: relative;
        min-height: 75vh;
        overflow: hidden;
        border-radius: 24px;
        background: linear-gradient(
            135deg,
            var(--bs-body-bg),
            var(--bs-secondary-bg)
        );
        color: var(--bs-body-color);
        padding: 45px 30px;
    }

    .tambah-pengembalian-wrapper::before {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        background: rgba(13, 110, 253, 0.08);
        border-radius: 50%;
        top: -180px;
        left: -130px;
        pointer-events: none;
    }

    .tambah-pengembalian-wrapper::after {
        content: "";
        position: absolute;
        width: 330px;
        height: 330px;
        background: rgba(255, 193, 7, 0.10);
        border-radius: 50%;
        bottom: -160px;
        right: -100px;
        pointer-events: none;
    }

    /* ================================
       CONTENT
    ================================= */

    .tambah-pengembalian-content {
        position: relative;
        z-index: 2;
        max-width: 850px;
        margin: 0 auto;
    }

    /* ================================
       HEADER
    ================================= */

    .tambah-pengembalian-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .tambah-pengembalian-badge {
        display: inline-block;
        background: linear-gradient(135deg, #0d6efd, #084298);
        color: #fff;
        font-weight: 600;
        padding: 9px 22px;
        border-radius: 50px;
        box-shadow: 0 6px 18px rgba(13, 110, 253, 0.25);
    }

    .tambah-pengembalian-title {
        color: var(--bs-heading-color);
        font-weight: 700;
        margin-top: 18px;
        margin-bottom: 10px;
    }

    .tambah-pengembalian-title span {
        background: linear-gradient(90deg, #0d6efd, #084298);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .tambah-pengembalian-line {
        width: 65px;
        height: 4px;
        margin: 0 auto;
        border-radius: 10px;
        background: linear-gradient(90deg, #0d6efd, #ffc107);
    }

    .tambah-pengembalian-description {
        color: var(--bs-secondary-color);
        margin-top: 15px;
        line-height: 1.7;
    }

    /* ================================
       ALERT
    ================================= */

    .tambah-pengembalian-alert {
        position: relative;
        z-index: 2;
        border-radius: 14px;
        margin-bottom: 24px;
    }

    /* ================================
       FORM
    ================================= */

    .tambah-pengembalian-form {
        background: color-mix(
            in srgb,
            var(--bs-body-bg) 92%,
            transparent
        );
        border: 1px solid var(--bs-border-color);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
    }

    .tambah-pengembalian-form label {
        display: block;
        font-weight: 600;
        color: var(--bs-heading-color);
        margin-bottom: 8px;
    }

    .tambah-pengembalian-form .form-control,
    .tambah-pengembalian-form .form-select {
        width: 100%;
        min-width: 0;
        min-height: 46px;
        padding: 12px 15px;
        border-radius: 11px;
        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);
        border: 1px solid var(--bs-border-color);
        transition: all 0.25s ease;
    }

    .tambah-pengembalian-form .form-control:focus,
    .tambah-pengembalian-form .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.12);
    }

    .tambah-pengembalian-form .form-control::placeholder {
        color: var(--bs-secondary-color);
    }

    .tambah-pengembalian-form textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .tambah-pengembalian-form .input-group {
        flex-wrap: nowrap;
    }

    .tambah-pengembalian-form .input-group .form-control {
        min-width: 0;
    }

    .tambah-pengembalian-form .input-group-text {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        background: var(--bs-secondary-bg);
        color: var(--bs-body-color);
        border: 1px solid var(--bs-border-color);
    }

    .tambah-pengembalian-form .input-group > :first-child {
        border-top-left-radius: 11px;
        border-bottom-left-radius: 11px;
    }

    .tambah-pengembalian-form .input-group > :last-child {
        border-top-right-radius: 11px;
        border-bottom-right-radius: 11px;
    }

    /* ================================
       BUTTON
    ================================= */

    .btn-tambah-pengembalian {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: none;
        border-radius: 11px;
        padding: 10px 20px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-tambah-pengembalian-primary {
        color: #fff;
        background: linear-gradient(135deg, #0d6efd, #084298);
        box-shadow: 0 6px 15px rgba(13, 110, 253, 0.20);
    }

    .btn-tambah-pengembalian-primary:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 9px 20px rgba(13, 110, 253, 0.28);
    }

    .btn-tambah-pengembalian-cancel {
        color: #102a43;
        background: linear-gradient(135deg, #ffc107, #ffda44);
        box-shadow: 0 6px 15px rgba(255, 193, 7, 0.20);
    }

    .btn-tambah-pengembalian-cancel:hover {
        color: #102a43;
        transform: translateY(-2px);
        box-shadow: 0 9px 20px rgba(255, 193, 7, 0.28);
    }

    /* ================================
       DARK MODE
    ================================= */

    [data-bs-theme="dark"] .tambah-pengembalian-wrapper {
        background: linear-gradient(
            135deg,
            var(--bs-body-bg),
            #172033
        );
    }

    [data-bs-theme="dark"] .tambah-pengembalian-wrapper::before {
        background: rgba(13, 110, 253, 0.12);
    }

    [data-bs-theme="dark"] .tambah-pengembalian-wrapper::after {
        background: rgba(255, 193, 7, 0.08);
    }

    [data-bs-theme="dark"] .tambah-pengembalian-form {
        background: rgba(255, 255, 255, 0.04);
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.18);
    }

    /* ================================
       MOBILE
    ================================= */

    @media (max-width: 768px) {
        .tambah-pengembalian-wrapper {
            padding: 30px 15px;
            min-height: 70vh;
        }

        .tambah-pengembalian-form {
            padding: 25px 20px;
        }

        .tambah-pengembalian-title {
            font-size: 1.8rem;
        }

        .tambah-pengembalian-form .input-group-text {
            padding: 12px 10px;
        }

        .btn-tambah-pengembalian {
            padding: 10px 14px;
        }
    }

    @media (max-width: 380px) {
        .tambah-pengembalian-actions {
            flex-direction: column-reverse;
        }

        .tambah-pengembalian-actions .btn {
            width: 100%;
        }
    }
</style>


<div class="container py-3 py-lg-4">

    <section class="tambah-pengembalian-wrapper">

        <div class="tambah-pengembalian-content">

            {{-- HEADER --}}
            <div class="tambah-pengembalian-header">

                <span class="tambah-pengembalian-badge">
                    🏐 SISTEM PEMINJAMAN ALAT VOLI
                </span>

                <h1 class="display-6 tambah-pengembalian-title">
                    Tambah <span>Pengembalian</span>
                </h1>

                <div class="tambah-pengembalian-line"></div>

                <p class="tambah-pengembalian-description">
                    Catat pengembalian alat dan lengkapi informasi
                    keterlambatan, denda, serta kondisi barang.
                </p>

            </div>


            {{-- ALERT VALIDASI --}}
             ```blade
@if (isset($errors) && $errors->any())
    <div class="alert alert-danger tambah-pengembalian-alert">
        <strong>
            Terdapat kesalahan pada data yang dimasukkan:
        </strong>

        <ul class="mb-0 mt-2 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```



            {{-- FORM --}}
            <form
                action="{{ route('pengembalian.store') }}"
                method="POST"
                class="tambah-pengembalian-form"
            >

                @csrf

                {{-- PEMINJAMAN --}}
                <div class="mb-4">

                    <label for="id_peminjaman">
                        Pilih Peminjaman
                    </label>

                    <select
                        name="id_peminjaman"
                        id="id_peminjaman"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Peminjaman Belum Dikembalikan --
                        </option>

                        @foreach ($peminjaman as $p)

                            @php
                                $pid = $p->id_peminjaman ?? $p->id;
                                $namaUser = $p->user->nama ?? $p->id_user ?? '-';
                                $namaAlat = $p->alat->nama_alat ?? $p->id_alat ?? '-';
                            @endphp

                            <option
                                value="{{ $pid }}"
                                {{ (string) old('id_peminjaman') === (string) $pid ? 'selected' : '' }}
                            >
                                ID #{{ $pid }}
                                (User: {{ $namaUser }}, Alat: {{ $namaAlat }})
                            </option>

                        @endforeach

                    </select>

                    @error('id_peminjaman')
                        <small class="text-danger d-block mt-2">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- TANGGAL PENGEMBALIAN --}}
                <div class="mb-4">

                    <label for="tanggal_pengembalian">
                        Tanggal Pengembalian
                    </label>

                    <input
                        type="datetime-local"
                        name="tanggal_pengembalian"
                        id="tanggal_pengembalian"
                        class="form-control"
                        value="{{ date('Y-m-d\TH:i') }}"
                        required
                    >

                    @error('tanggal_pengembalian')
                        <small class="text-danger d-block mt-2">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- KETERLAMBATAN DAN DENDA --}}
                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label for="terlambat_hari">
                            Keterlambatan
                        </label>

                        <div class="input-group">

                            <input
                                type="number"
                                name="terlambat_hari"
                                id="terlambat_hari"
                                class="form-control"
                                value="{{ old('terlambat_hari', 0) }}"
                                min="0"
                                required
                            >

                            <span class="input-group-text">
                                Hari
                            </span>

                        </div>

                        @error('terlambat_hari')
                            <small class="text-danger d-block mt-2">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <div class="col-md-6 mb-4">

                        <label for="denda">
                            Denda
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                Rp
                            </span>

                            <input
                                type="number"
                                name="denda"
                                id="denda"
                                class="form-control"
                                value="{{ old('denda', 0) }}"
                                min="0"
                                required
                            >

                        </div>

                        @error('denda')
                            <small class="text-danger d-block mt-2">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>


                {{-- KONDISI BARANG --}}
                <div class="mb-4">

                    <label for="kondisi_barang">
                        Kondisi Barang
                    </label>

                    <select
                        name="kondisi_barang"
                        id="kondisi_barang"
                        class="form-select"
                        required
                    >

                        <option
                            value="Baik"
                            {{ old('kondisi_barang', 'Baik') == 'Baik' ? 'selected' : '' }}
                        >
                            Baik
                        </option>

                        <option
                            value="Rusak Ringan"
                            {{ old('kondisi_barang') == 'Rusak Ringan' ? 'selected' : '' }}
                        >
                            Rusak Ringan
                        </option>

                        <option
                            value="Rusak Berat"
                            {{ old('kondisi_barang') == 'Rusak Berat' ? 'selected' : '' }}
                        >
                            Rusak Berat
                        </option>

                        <option
                            value="Hilang"
                            {{ old('kondisi_barang') == 'Hilang' ? 'selected' : '' }}
                        >
                            Hilang
                        </option>

                    </select>

                    @error('kondisi_barang')
                        <small class="text-danger d-block mt-2">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- CATATAN --}}
                <div class="mb-4">

                    <label for="catatan">
                        Catatan
                        <span class="text-body-secondary fw-normal">
                            (Opsional)
                        </span>
                    </label>

                    <textarea
                        name="catatan"
                        id="catatan"
                        rows="4"
                        class="form-control"
                        placeholder="Tambahkan catatan jika diperlukan..."
                    >{{ old('catatan') }}</textarea>

                    @error('catatan')
                        <small class="text-danger d-block mt-2">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- TOMBOL AKSI --}}
                <div class="d-flex flex-wrap justify-content-end gap-2 pt-3 tambah-pengembalian-actions">

                    <a
                        href="{{ route('pengembalian.index') }}"
                        class="btn btn-tambah-pengembalian btn-tambah-pengembalian-cancel"
                    >
                        ↩ Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-tambah-pengembalian btn-tambah-pengembalian-primary"
                    >
                        💾 Simpan Pengembalian
                    </button>

                </div>

            </form>

        </div>

    </section>

</div>

@endsection
```
