@extends('layouts.app')

@section('title', 'Admin')

@section('content')

<style>
    /* =========================================================
       ADMIN VOLLEYBALL THEME
       ========================================================= */

    .admin-hero {
        position: relative;
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 24px;
        background: linear-gradient(
            135deg,
            var(--bs-body-bg),
            var(--bs-secondary-bg)
        );
        color: var(--bs-body-color);
    }

    .admin-content {
        position: relative;
        z-index: 2;
        width: 100%;
        text-align: center;
        padding: 50px 20px;
    }

    /* =========================================================
       BACKGROUND
       ========================================================= */

    .admin-hero::before {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        background: rgba(13, 110, 253, 0.08);
        border-radius: 50%;
        top: -180px;
        left: -130px;
    }

    .admin-hero::after {
        content: "";
        position: absolute;
        width: 330px;
        height: 330px;
        background: rgba(255, 193, 7, 0.10);
        border-radius: 50%;
        bottom: -160px;
        right: -100px;
    }

    /* =========================================================
       BADGE
       ========================================================= */

    .badge-admin {
        background: linear-gradient(135deg, #0d6efd, #084298);
        color: #fff;
        font-weight: 600;
        box-shadow: 0 6px 18px rgba(13, 110, 253, 0.25);
    }

    /* =========================================================
       TITLE
       ========================================================= */

    .admin-title {
        color: var(--bs-heading-color);
        letter-spacing: -1px;
    }

    .text-admin {
        background: linear-gradient(90deg, #0d6efd, #084298);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .admin-description {
        color: var(--bs-secondary-color);
        line-height: 1.8;
    }

    /* =========================================================
       LINE
       ========================================================= */

    .admin-line {
        width: 65px;
        height: 4px;
        margin: 0 auto 22px;
        border-radius: 10px;
        background: linear-gradient(
            90deg,
            #0d6efd,
            #ffc107
        );
    }

    /* =========================================================
       MENU ADMIN
       ========================================================= */

    .admin-menu {
        margin: 30px auto 0;
        max-width: 850px;
        padding: 25px;
        border-radius: 20px;

        background: color-mix(
            in srgb,
            var(--bs-body-bg) 85%,
            transparent
        );

        border: 1px solid var(--bs-border-color);

        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);

        backdrop-filter: blur(10px);
    }

    .admin-card {
        display: block;
        height: 100%;
        padding: 25px;
        border-radius: 16px;

        background: var(--bs-body-bg);
        border: 1px solid var(--bs-border-color);

        color: var(--bs-body-color);
        text-decoration: none;

        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);

        transition: all 0.3s ease;
    }

    .admin-card:hover {
        transform: translateY(-5px);
        border-color: #0d6efd;
        box-shadow: 0 12px 25px rgba(13, 110, 253, 0.15);
        color: var(--bs-body-color);
    }

    .admin-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;

        margin: 0 auto 15px;

        border-radius: 14px;

        background: linear-gradient(
            135deg,
            #0d6efd,
            #084298
        );

        color: #fff;

        font-size: 22px;

        box-shadow: 0 6px 15px rgba(13, 110, 253, 0.20);
    }

    .admin-card h2 {
        color: var(--bs-heading-color);
    }

    .admin-card p {
        color: var(--bs-secondary-color);
    }

    /* =========================================================
       VOLLEYBALL
       ========================================================= */

    .volleyball {
        position: absolute;
        width: 105px;
        height: 105px;
        border-radius: 50%;

        background: var(--bs-body-bg);
        border: 4px solid var(--bs-heading-color);

        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);

        z-index: 1;
        opacity: 0.95;
    }

    .volleyball::before {
        content: "";
        position: absolute;
        width: 85px;
        height: 42px;

        border-top: 6px solid #0d6efd;
        border-radius: 50%;

        top: 17px;
        left: 5px;

        transform: rotate(35deg);
    }

    .volleyball::after {
        content: "";
        position: absolute;
        width: 70px;
        height: 35px;

        border-bottom: 6px solid #ffc107;
        border-radius: 50%;

        bottom: 17px;
        right: 5px;

        transform: rotate(-35deg);
    }

    .ball-one {
        top: 10%;
        left: 7%;
        animation: floating 4s ease-in-out infinite;
    }

    .ball-two {
        bottom: 8%;
        right: 7%;
        width: 75px;
        height: 75px;

        animation: floating 5s ease-in-out infinite reverse;
    }

    .ball-two::before {
        width: 60px;
        height: 30px;
        border-width: 4px;
    }

    .ball-two::after {
        width: 50px;
        height: 25px;
        border-width: 4px;
    }

    /* =========================================================
       ANIMATION
       ========================================================= */

    @keyframes floating {

        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }

        50% {
            transform: translateY(-15px) rotate(8deg);
        }

    }

    /* =========================================================
       DARK MODE
       ========================================================= */

    [data-bs-theme="dark"] .admin-hero {
        background: linear-gradient(
            135deg,
            var(--bs-body-bg),
            #172033
        );
    }

    [data-bs-theme="dark"] .admin-menu {
        background: rgba(255, 255, 255, 0.05);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.30);
    }

    [data-bs-theme="dark"] .admin-card {
        background: rgba(255, 255, 255, 0.04);
    }

    [data-bs-theme="dark"] .admin-hero::before {
        background: rgba(13, 110, 253, 0.12);
    }

    [data-bs-theme="dark"] .admin-hero::after {
        background: rgba(255, 193, 7, 0.08);
    }

    /* =========================================================
       MOBILE
       ========================================================= */

    @media (max-width: 768px) {

        .admin-hero {
            min-height: 70vh;
        }

        .admin-content {
            padding: 40px 15px;
        }

        .volleyball {
            width: 65px;
            height: 65px;
        }

        .volleyball::before {
            width: 52px;
            height: 25px;
            border-width: 4px;
        }

        .volleyball::after {
            width: 45px;
            height: 20px;
            border-width: 4px;
        }

        .ball-one {
            top: 7%;
            left: 4%;
        }

        .ball-two {
            bottom: 6%;
            right: 4%;
        }

        .admin-menu {
            padding: 15px;
        }

    }
</style>


<div class="container py-3 py-lg-4">

    <section class="admin-hero">

        {{-- Bola voli dekorasi --}}
        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>

        <div class="admin-content">

            {{-- Badge --}}
            <span class="badge rounded-pill badge-admin px-4 py-2 mb-4">
                🏐 AREA ADMIN
            </span>

            {{-- Garis --}}
            <div class="admin-line"></div>

            {{-- Judul --}}
            <h1 class="display-5 fw-bold mb-3 admin-title">

                Halo,
                <span class="text-admin">
                    {{ $user->username }}
                </span>

            </h1>

            {{-- Deskripsi --}}
            <p class="lead admin-description mx-auto mb-4"
               style="max-width: 650px;">

                Selamat datang di panel administrasi
                Sistem Peminjaman Alat Olahraga Voli.

            </p>

            {{-- Menu Admin --}}
            <div class="admin-menu">

                <div class="row g-3">

                    {{-- Manage Role --}}
                    <div class="col-md-4">

                        <a href="{{ route('admin.roles.index') }}"
                           class="admin-card">

                            <div class="admin-icon">
                                👥
                            </div>

                            <h2 class="h6 fw-bold mb-2">
                                Manage Role
                            </h2>

                            <p class="small mb-0">
                                Tambah role baru untuk dipakai
                                saat membuat user.
                            </p>

                        </a>

                    </div>

                    {{-- Manage User --}}
                    <div class="col-md-4">

                        <a href="{{ route('admin.users.index') }}"
                           class="admin-card">

                            <div class="admin-icon">
                                👤
                            </div>

                            <h2 class="h6 fw-bold mb-2">
                                Manage User
                            </h2>

                            <p class="small mb-0">
                                Tambah user baru dan tentukan
                                role-nya.
                            </p>

                        </a>

                    </div>

                    {{-- Download Database --}}
                    <div class="col-md-4">

                        <a href="{{ route('admin.database.export') }}"
                           class="admin-card">

                            <div class="admin-icon">
                                💾
                            </div>

                            <h2 class="h6 fw-bold mb-2">
                                Download Database
                            </h2>

                            <p class="small mb-0">
                                Unduh seluruh isi database
                                menjadi file .sql.
                            </p>

                        </a>

                    </div>

                </div>

            </div>

            <p class="text-secondary small mt-4 mb-0">
                Halaman ini hanya dapat diakses oleh role
                <strong>admin</strong>.
            </p>

        </div>

    </section>

</div>

@endsection