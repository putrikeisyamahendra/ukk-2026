@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

<style>
    /* ================================
       BACKGROUND
    ================================= */

    .kategori-wrapper {
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

    .kategori-wrapper::before {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        background: rgba(13, 110, 253, 0.08);
        border-radius: 50%;
        top: -180px;
        left: -130px;
    }

    .kategori-wrapper::after {
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

    .kategori-content {
        position: relative;
        z-index: 2;
        max-width: 850px;
        margin: 0 auto;
    }


    /* ================================
       HEADER
    ================================= */

    .kategori-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .kategori-badge {
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

    .kategori-title {
        color: var(--bs-heading-color);
        font-weight: 700;
        margin-top: 18px;
        margin-bottom: 10px;
    }

    .kategori-title span {
        background: linear-gradient(
            90deg,
            #0d6efd,
            #084298
        );
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .kategori-line {
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

    .kategori-form {
        background: color-mix(
            in srgb,
            var(--bs-body-bg) 92%,
            transparent
        );

        border: 1px solid var(--bs-border-color);

        border-radius: 20px;

        padding: 35px;

        /* Shadow dibuat ringan supaya tidak terlihat ngambang */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
    }

    .kategori-form label {
        display: block;
        font-weight: 600;
        color: var(--bs-heading-color);
        margin-bottom: 8px;
    }

    .kategori-form .form-control {
        border-radius: 11px;
        padding: 12px 15px;

        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);

        border: 1px solid var(--bs-border-color);

        transition: all 0.25s ease;
    }

    .kategori-form .form-control:focus {
        border-color: #0d6efd;

        box-shadow:
            0 0 0 0.2rem rgba(13, 110, 253, 0.12);
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

        box-shadow:
            0 6px 15px rgba(13, 110, 253, 0.20);

        transition: all 0.3s ease;
    }

    .btn-volley:hover {
        color: #fff;
        transform: translateY(-2px);

        box-shadow:
            0 9px 20px rgba(13, 110, 253, 0.28);
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

        box-shadow:
            0 6px 15px rgba(255, 193, 7, 0.20);

        transition: all 0.3s ease;
    }

    .btn-volley-yellow:hover {
        color: #102a43;
        transform: translateY(-2px);
    }


    /* ================================
       DARK MODE
    ================================= */

    [data-bs-theme="dark"] .kategori-wrapper {
        background: linear-gradient(
            135deg,
            var(--bs-body-bg),
            #172033
        );
    }

    [data-bs-theme="dark"] .kategori-form {
        background: rgba(255, 255, 255, 0.04);

        box-shadow:
            0 4px 18px rgba(0, 0, 0, 0.18);
    }

    [data-bs-theme="dark"] .kategori-wrapper::before {
        background: rgba(13, 110, 253, 0.12);
    }

    [data-bs-theme="dark"] .kategori-wrapper::after {
        background: rgba(255, 193, 7, 0.08);
    }


    /* ================================
       MOBILE
    ================================= */

    @media (max-width: 768px) {

        .kategori-wrapper {
            padding: 30px 15px;
            min-height: 70vh;
        }

        .kategori-form {
            padding: 25px 20px;
        }

    }
</style>


<div class="container py-3 py-lg-4">

    <section class="kategori-wrapper">

        <div class="kategori-content">

            {{-- HEADER --}}
            <div class="kategori-header">

                <span class="kategori-badge">
                    🏐 KATEGORI ALAT OLAHRAGA
                </span>

                <h1 class="display-6 kategori-title">
                    Edit <span>Kategori</span>
                </h1>

                <div class="kategori-line"></div>

            </div>


            {{-- FORM --}}
            <form
                action="{{ route('kategori.update', ['id_kategori' => $data->id_kategori]) }}"
                method="POST"
                class="kategori-form"
            >

                @csrf
                @method('PUT')

                <div class="mb-4">

                    <label for="keterangan">
                        Keterangan
                    </label>

                    <input
                        type="text"
                        name="keterangan"
                        id="keterangan"
                        class="form-control"
                        value="{{ $data->keterangan }}"
                        required
                    >

                </div>


                <div class="mb-4">

                    <label for="kode_kategori">
                        Kode Kategori
                    </label>

                    <input
                        type="text"
                        name="kode_kategori"
                        id="kode_kategori"
                        class="form-control"
                        value="{{ $data->kode_kategori }}"
                        required
                    >

                </div>


                <div class="mb-4">

                    <label for="nama_kategori">
                        Nama Kategori
                    </label>

                    <input
                        type="text"
                        name="nama_kategori"
                        id="nama_kategori"
                        class="form-control"
                        value="{{ $data->nama_kategori }}"
                        required
                    >

                </div>


                <div class="d-flex flex-wrap gap-2">

                    <button
                        type="submit"
                        class="btn btn-volley px-4 py-2"
                    >
                        💾 Simpan Perubahan
                    </button>

                    <a
                        href="{{ route('kategori.index') }}"
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
