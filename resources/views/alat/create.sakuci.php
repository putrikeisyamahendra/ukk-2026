```php
@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambahkan Alat')

@section('content')

<style>
    /* ================================
       BACKGROUND
    ================================= */

    .alat-wrapper {
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

    .alat-wrapper::before {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        background: rgba(13, 110, 253, 0.08);
        border-radius: 50%;
        top: -180px;
        left: -130px;
    }

    .alat-wrapper::after {
        content: "";
        position: absolute;
        width: 330px;
        height: 330px;
        background: rgba(255, 193, 7, 0.10);
        border-radius: 50%;
        bottom: -160px;
        right: -100px;
    }


    /* ================================
       CONTENT
    ================================= */

    .alat-content {
        position: relative;
        z-index: 2;
        max-width: 850px;
        margin: 0 auto;
    }


    /* ================================
       HEADER
    ================================= */

    .alat-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .alat-badge {
        display: inline-block;
        background: linear-gradient(
            135deg,
            #0d6efd,
            #084298
        );
        color: #fff;
        font-weight: 600;
        padding: 9px 22px;
        border-radius: 50px;
        box-shadow: 0 6px 18px rgba(13, 110, 253, 0.25);
    }

    .alat-title {
        color: var(--bs-heading-color);
        font-weight: 700;
        margin-top: 18px;
        margin-bottom: 10px;
    }

    .alat-title span {
        background: linear-gradient(
            90deg,
            #0d6efd,
            #084298
        );
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .alat-line {
        width: 65px;
        height: 4px;
        margin: 0 auto;
        border-radius: 10px;
        background: linear-gradient(
            90deg,
            #0d6efd,
            #ffc107
        );
    }


    /* ================================
       FORM
    ================================= */

    .alat-form {
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

    .alat-form label {
        display: block;
        font-weight: 600;
        color: var(--bs-heading-color);
        margin-bottom: 8px;
    }

    .alat-form .form-control {
        border-radius: 11px;
        padding: 12px 15px;
        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);
        border: 1px solid var(--bs-border-color);
        transition: all 0.25s ease;
    }

    .alat-form .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.12);
    }


    /* ================================
       BUTTON
    ================================= */

    .btn-volley {
        border: none;
        border-radius: 11px;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(
            135deg,
            #0d6efd,
            #084298
        );
        box-shadow: 0 6px 15px rgba(13, 110, 253, 0.20);
        transition: all 0.3s ease;
    }

    .btn-volley:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 9px 20px rgba(13, 110, 253, 0.28);
    }

    .btn-volley-yellow {
        border: none;
        border-radius: 11px;
        font-weight: 700;
        color: #102a43;
        background: linear-gradient(
            135deg,
            #ffc107,
            #ffda44
        );
        box-shadow: 0 6px 15px rgba(255, 193, 7, 0.20);
        transition: all 0.3s ease;
    }

    .btn-volley-yellow:hover {
        color: #102a43;
        transform: translateY(-2px);
    }


    /* ================================
       DARK MODE
    ================================= */

    [data-bs-theme="dark"] .alat-wrapper {
        background: linear-gradient(
            135deg,
            var(--bs-body-bg),
            #172033
        );
    }

    [data-bs-theme="dark"] .alat-form {
        background: rgba(255, 255, 255, 0.04);
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.18);
    }

    [data-bs-theme="dark"] .alat-wrapper::before {
        background: rgba(13, 110, 253, 0.12);
    }

    [data-bs-theme="dark"] .alat-wrapper::after {
        background: rgba(255, 193, 7, 0.08);
    }


    /* ================================
       MOBILE
    ================================= */

    @media (max-width: 768px) {
        .alat-wrapper {
            padding: 30px 15px;
            min-height: 70vh;
        }

        .alat-form {
            padding: 25px 20px;
        }
    }
</style>


<div class="container py-3 py-lg-4">

    <section class="alat-wrapper">

        <div class="alat-content">

            {{-- HEADER --}}
            <div class="alat-header">

                <span class="alat-badge">
                    🏐 ALAT OLAHRAGA VOLI
                </span>

                <h1 class="display-6 alat-title">
                    Tambahkan <span>Alat</span>
                </h1>

                <div class="alat-line"></div>

            </div>


            {{-- FORM --}}
            <form
                action="{{ route('alat.store') }}"
                method="POST"
                class="alat-form"
            >

                @csrf

                <div class="mb-4">

                    <label for="nama_alat">
                        Nama Alat
                    </label>

                    <input
                        type="text"
                        name="nama_alat"
                        id="nama_alat"
                        class="form-control"
                        value="{{ old('nama_alat') }}"
                        placeholder="Masukkan nama alat"
                        required
                    >

                </div>


                <div class="mb-4">

                    <label for="kode_alat">
                        Kode Alat
                    </label>

                    <input
                        type="text"
                        name="kode_alat"
                        id="kode_alat"
                        class="form-control"
                        value="{{ old('kode_alat') }}"
                        placeholder="Masukkan kode alat"
                        required
                    >

                </div>


                <div class="mb-4">

                    <label for="id_kategori">
                        Kategori
                    </label>

                    <select
                        name="id_kategori"
                        id="id_kategori"
                        class="form-control"
                        required
                    >

                        <option value="">-- Pilih Kategori --</option>

                        @foreach ($kategori as $k)
                            <option
                                value="{{ $k->id_kategori }}"
                                {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}
                            >
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach

                    </select>

                </div>


                <div class="mb-4">

                    <label for="stok">
                        Stok
                    </label>

                    <input
                        type="number"
                        name="stok"
                        id="stok"
                        class="form-control"
                        value="{{ old('stok', 0) }}"
                        min="0"
                        placeholder="Masukkan jumlah stok"
                        required
                    >

                </div>


                <div class="d-flex flex-wrap gap-2">

                    <button
                        type="submit"
                        class="btn btn-volley px-4 py-2"
                    >
                        💾 Simpan
                    </button>

                    <a
                        href="{{ route('alat.index') }}"
                        class="btn btn-volley-yellow px-4 py-2"
                    >
                        ↩ Kembali
                    </a>

                </div>

            </form>

        </div>

    </section>

</div>

@endsection
```
