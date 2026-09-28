@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Peminjaman')

@section('content')

<style>
    /* ================================
       BACKGROUND
    ================================= */

    .peminjaman-wrapper {
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

    .peminjaman-wrapper::before {
        content: "";
        position: absolute;

        width: 420px;
        height: 420px;

        background: rgba(13, 110, 253, 0.08);

        border-radius: 50%;

        top: -180px;
        left: -130px;
    }

    .peminjaman-wrapper::after {
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

    .peminjaman-content {
        position: relative;
        z-index: 2;

        max-width: 850px;
        margin: 0 auto;
    }


    /* ================================
       HEADER
    ================================= */

    .peminjaman-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .peminjaman-badge {
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

        box-shadow:
            0 6px 18px rgba(13, 110, 253, 0.25);
    }

    .peminjaman-title {
        color: var(--bs-heading-color);

        font-weight: 700;

        margin-top: 18px;
        margin-bottom: 10px;
    }

    .peminjaman-title span {
        background: linear-gradient(
            90deg,
            #0d6efd,
            #084298
        );

        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;

        background-clip: text;
    }

    .peminjaman-line {
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

    .peminjaman-form {
        background: color-mix(
            in srgb,
            var(--bs-body-bg) 92%,
            transparent
        );

        border: 1px solid var(--bs-border-color);

        border-radius: 20px;

        padding: 35px;

        box-shadow:
            0 4px 15px rgba(0, 0, 0, 0.06);
    }

    .peminjaman-form label {
        display: block;

        font-weight: 600;

        color: var(--bs-heading-color);

        margin-bottom: 8px;
    }

    .peminjaman-form .form-control {
        border-radius: 11px;

        padding: 12px 15px;

        background-color: var(--bs-body-bg);

        color: var(--bs-body-color);

        border: 1px solid var(--bs-border-color);

        transition: all 0.25s ease;
    }

    .peminjaman-form .form-control:focus {
        border-color: #0d6efd;

        box-shadow:
            0 0 0 0.2rem rgba(13, 110, 253, 0.12);
    }

    .peminjaman-form select.form-control {
        cursor: pointer;
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

    [data-bs-theme="dark"] .peminjaman-wrapper {
        background: linear-gradient(
            135deg,
            var(--bs-body-bg),
            #172033
        );
    }

    [data-bs-theme="dark"] .peminjaman-form {
        background: rgba(255, 255, 255, 0.04);

        box-shadow:
            0 4px 18px rgba(0, 0, 0, 0.18);
    }

    [data-bs-theme="dark"] .peminjaman-wrapper::before {
        background: rgba(13, 110, 253, 0.12);
    }

    [data-bs-theme="dark"] .peminjaman-wrapper::after {
        background: rgba(255, 193, 7, 0.08);
    }


    /* ================================
       MOBILE
    ================================= */

    @media (max-width: 768px) {

        .peminjaman-wrapper {
            padding: 30px 15px;

            min-height: 70vh;
        }

        .peminjaman-form {
            padding: 25px 20px;
        }

    }
</style>


<div class="container py-3 py-lg-4">

    <section class="peminjaman-wrapper">

        <div class="peminjaman-content">

            {{-- ================================
                 HEADER
            ================================= --}}

            <div class="peminjaman-header">

                <span class="peminjaman-badge">
                    🏐 TRANSAKSI PEMINJAMAN
                </span>

                <h1 class="display-6 peminjaman-title">
                    Edit <span>Data Peminjaman</span>
                </h1>

                <div class="peminjaman-line"></div>

            </div>


            {{-- ================================
                 FORM
            ================================= --}}

            <form
                action="{{ route('peminjaman.update', ['id_peminjaman' => $data->id_peminjaman]) }}"
                method="POST"
                class="peminjaman-form"
            >

                @csrf
                @method('PUT')


                {{-- USER --}}

                <div class="mb-4">

                    <label for="id_user">
                        Pilih User / Peminjam
                    </label>

                    <select
                        name="id_user"
                        id="id_user"
                        class="form-control"
                        required
                    >

                        @foreach($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ $data->id_user == $user->id ? 'selected' : '' }}
                            >
                                {{ $user->username }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- ALAT --}}

                <div class="mb-4">

                    <label for="id_alat">
                        Pilih Alat
                    </label>

                    <select
                        name="id_alat"
                        id="id_alat"
                        class="form-control"
                        required
                    >

                        @foreach($alat as $item)

                            <option
                                value="{{ $item->id_alat }}"
                                {{ $data->id_alat == $item->id_alat ? 'selected' : '' }}
                            >
                                {{ $item->nama_alat }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- JUMLAH --}}

                <div class="mb-4">

                    <label for="jumlah">
                        Jumlah
                    </label>

                    <input
                        type="number"
                        name="jumlah"
                        id="jumlah"
                        class="form-control"
                        value="{{ $data->jumlah }}"
                        min="1"
                        required
                    >

                </div>


                {{-- TANGGAL PINJAM --}}

                <div class="mb-4">

                    <label for="tanggal_pinjam">
                        Tanggal Pinjam
                    </label>

                    <input
                        type="date"
                        name="tanggal_pinjam"
                        id="tanggal_pinjam"
                        class="form-control"
                        value="{{ $data->tanggal_pinjam }}"
                        required
                    >

                </div>


                {{-- TANGGAL KEMBALI --}}

                <div class="mb-4">

                    <label for="tanggal_kembali">
                        Tanggal Kembali (Aktual)
                    </label>

                    <input
                        type="date"
                        name="tanggal_kembali"
                        id="tanggal_kembali"
                        class="form-control"
                        value="{{ $data->tanggal_kembali }}"
                    >

                </div>


                {{-- STATUS --}}

                <div class="mb-4">

                    <label for="status">
                        Status
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-control"
                        required
                    >

                        <option
                            value="Pending"
                            {{ $data->status == 'Pending' ? 'selected' : '' }}
                        >
                            Pending
                        </option>

                        <option
                            value="Disetujui"
                            {{ $data->status == 'Disetujui' ? 'selected' : '' }}
                        >
                            Disetujui
                        </option>

                        <option
                            value="Ditolak"
                            {{ $data->status == 'Ditolak' ? 'selected' : '' }}
                        >
                            Ditolak
                        </option>

                        <option
                            value="Dikembalikan"
                            {{ $data->status == 'Dikembalikan' ? 'selected' : '' }}
                        >
                            Dikembalikan
                        </option>

                    </select>

                </div>


                {{-- DENDA --}}

                <div class="mb-4">

                    <label for="denda">
                        Denda (Rp)
                    </label>

                    <input
                        type="number"
                        name="denda"
                        id="denda"
                        class="form-control"
                        value="{{ $data->denda }}"
                        min="0"
                    >

                </div>


                {{-- BUTTON --}}

                <div class="d-flex flex-wrap gap-2">

                    <button
                        type="submit"
                        class="btn btn-volley px-4 py-2"
                    >
                        💾 Update Data
                    </button>

                    <a
                        href="{{ route('peminjaman.index') }}"
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
