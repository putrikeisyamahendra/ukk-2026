@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
    /* =========================================================
       VOLLEYBALL DASHBOARD THEME
       ========================================================= */

    .dashboard-hero {
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

    .dashboard-content {
        position: relative;
        z-index: 2;
        text-align: center;
        padding: 50px 20px;
        max-width: 850px;
    }

    /* =========================================================
       BACKGROUND DECORATION
       ========================================================= */

    .dashboard-hero::before {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        background: rgba(13, 110, 253, 0.08);
        border-radius: 50%;
        top: -180px;
        left: -130px;
    }

    .dashboard-hero::after {
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

    .badge-dashboard {
        background: linear-gradient(135deg, #0d6efd, #084298);
        color: #fff;
        font-weight: 600;
        box-shadow: 0 6px 18px rgba(13, 110, 253, 0.25);
    }

    /* =========================================================
       TITLE
       ========================================================= */

    .dashboard-title {
        color: var(--bs-heading-color);
        letter-spacing: -1px;
    }

    .text-dashboard {
        background: linear-gradient(90deg, #0d6efd, #084298);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .dashboard-description {
        color: var(--bs-secondary-color);
        line-height: 1.8;
    }

    /* =========================================================
       LINE
       ========================================================= */

    .dashboard-line {
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
       DASHBOARD CARD
       ========================================================= */

    .dashboard-card {
        margin: 30px auto 0;
        max-width: 550px;
        padding: 24px;
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

    .dashboard-info {
        padding: 15px 20px;
        border-radius: 14px;
        background: rgba(13, 110, 253, 0.06);
        border: 1px solid rgba(13, 110, 253, 0.12);
    }

    .dashboard-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--bs-secondary-color);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .dashboard-value {
        color: #0d6efd;
        font-weight: 700;
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
        top: 12%;
        left: 7%;
        animation: floating 4s ease-in-out infinite;
    }

    .ball-two {
        bottom: 10%;
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

    [data-bs-theme="dark"] .dashboard-hero {
        background: linear-gradient(
            135deg,
            var(--bs-body-bg),
            #172033
        );
    }

    [data-bs-theme="dark"] .dashboard-card {
        background: rgba(255, 255, 255, 0.05);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.30);
    }

    [data-bs-theme="dark"] .dashboard-hero::before {
        background: rgba(13, 110, 253, 0.12);
    }

    [data-bs-theme="dark"] .dashboard-hero::after {
        background: rgba(255, 193, 7, 0.08);
    }

    [data-bs-theme="dark"] .dashboard-info {
        background: rgba(13, 110, 253, 0.10);
        border-color: rgba(13, 110, 253, 0.20);
    }

    /* =========================================================
       MOBILE
       ========================================================= */

    @media (max-width: 768px) {

        .dashboard-hero {
            min-height: 70vh;
        }

        .dashboard-content {
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

        .dashboard-card {
            padding: 18px;
        }
    }
</style>


<div class="container py-3 py-lg-4">

    <section class="dashboard-hero">

        {{-- Bola voli dekorasi --}}
        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>

        <div class="dashboard-content">

            {{-- Badge role --}}
            <span class="badge rounded-pill badge-dashboard px-4 py-2 mb-4">
                🏐 ROLE: {{ strtoupper($user->role) }}
            </span>

            {{-- Garis dekorasi --}}
            <div class="dashboard-line"></div>

            {{-- Judul --}}
            <h1 class="display-5 fw-bold mb-3 dashboard-title">

                Halo,
                <span class="text-dashboard">
                    {{ $user->username }}
                </span>

            </h1>

            {{-- Deskripsi --}}
            <p class="lead dashboard-description mx-auto mb-4"
               style="max-width: 650px;">

                Selamat datang di dashboard Sistem Peminjaman
                Alat Olahraga Voli.

            </p>

            {{-- Informasi user --}}
            <div class="dashboard-card">

                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="dashboard-info">
                            <div class="dashboard-label">
                                Username
                            </div>

                            <div class="dashboard-value">
                                {{ $user->username }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="dashboard-info">
                            <div class="dashboard-label">
                                Role
                            </div>

                            <div class="dashboard-value">
                                {{ ucfirst($user->role) }}
                            </div>
                        </div>
                    </div>

                </div>

                <p class="text-secondary small mb-0 mt-4">
                    Silakan gunakan menu navigasi di atas
                    untuk mengakses fitur sistem.
                </p>

            </div>

        </div>

    </section>

</div>

@endsection
