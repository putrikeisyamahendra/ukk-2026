@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
html:has(.admin-hero),
html:has(.admin-hero) body {
    overflow: hidden;
}

.admin-hero {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 260px;
    z-index: 1;
    display: flex;
    overflow-x: hidden;
    overflow-y: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
    border-radius: 0;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    color: var(--bs-body-color);
    transition: left .3s ease;
}

.admin-hero::-webkit-scrollbar {
    display: none;
}

:root:has(#sidebarToggle:checked) .admin-hero {
    left: 0;
}

.admin-hero::before {
    content: "";
    position: fixed;
    width: 420px;
    height: 420px;
    background: rgba(13, 110, 253, 0.08);
    border-radius: 50%;
    top: -180px;
    left: -130px;
    pointer-events: none;
}

.admin-hero::after {
    content: "";
    position: fixed;
    width: 330px;
    height: 330px;
    background: rgba(255, 193, 7, 0.10);
    border-radius: 50%;
    bottom: -160px;
    right: -100px;
    pointer-events: none;
}

.admin-content {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 800px;
    margin: auto;
    text-align: center;
    padding: 40px 20px;
}

.badge-admin {
    background: linear-gradient(135deg, #0d6efd, #084298);
    color: #fff;
    font-weight: 600;
    box-shadow: 0 6px 18px rgba(13, 110, 253, 0.25);
}

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

.admin-line {
    width: 65px;
    height: 4px;
    margin: 0 auto 22px;
    border-radius: 10px;
    background: linear-gradient(90deg, #0d6efd, #ffc107);
}

.admin-card {
    padding: 20px;
    border-radius: 16px;
    background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color);
    color: var(--bs-body-color);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
}

.admin-card small {
    display: block;
    color: var(--bs-secondary-color);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.admin-card strong {
    color: #0d6efd;
    font-size: 20px;
}

.btn-volley {
    border: none;
    border-radius: 12px;
    font-weight: 700;
    color: #fff;
    background: linear-gradient(135deg, #0d6efd, #084298);
    box-shadow: 0 7px 18px rgba(13, 110, 253, 0.22);
    transition: all 0.3s ease;
}

.btn-volley:hover {
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 11px 25px rgba(13, 110, 253, 0.32);
}

.volleyball {
    position: fixed;
    width: 85px;
    height: 85px;
    border-radius: 50%;
    background: var(--bs-tertiary-bg);
    border: none;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
    z-index: 1;
    opacity: 0.95;
}

.volleyball::before {
    content: "";
    position: absolute;
    width: 68px;
    height: 34px;
    border-top: 5px solid #0d6efd;
    border-radius: 50%;
    top: 14px;
    left: 4px;
    transform: rotate(35deg);
}

.volleyball::after {
    content: "";
    position: absolute;
    width: 56px;
    height: 28px;
    border-bottom: 5px solid #ffc107;
    border-radius: 50%;
    bottom: 14px;
    right: 4px;
    transform: rotate(-35deg);
}

.ball-one {
    top: 15%;
    left: calc(260px + 5%);
    animation: floating 4s ease-in-out infinite;
    transition: left .3s ease;
}

:root:has(#sidebarToggle:checked) .ball-one {
    left: 5%;
}

.ball-two {
    bottom: 10%;
    right: 7%;
    width: 65px;
    height: 65px;
    animation: floating 5s ease-in-out infinite reverse;
}

.ball-two::before {
    width: 52px;
    height: 25px;
    border-width: 4px;
}

.ball-two::after {
    width: 44px;
    height: 22px;
    border-width: 4px;
}

@keyframes floating {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(8deg); }
}

@media (max-width: 991px) {
    .admin-hero,
    :root:has(#sidebarToggle:checked) .admin-hero {
        left: 0;
    }

    .ball-one,
    :root:has(#sidebarToggle:checked) .ball-one {
        left: 4%;
    }
}

@media (max-width: 768px) {
    .volleyball {
        display: none;
    }
}
</style>

<section class="admin-hero">

    <div class="volleyball ball-one"></div>
    <div class="volleyball ball-two"></div>

    <div class="admin-content">

        <span class="badge rounded-pill badge-admin px-4 py-2 mb-4">
            🏐 ROLE: PEMINJAM
        </span>

        <div class="admin-line"></div>

        <h1 class="display-5 fw-bold mb-3 admin-title">
            Halo,
            <span class="text-admin">{{ \App\Models\User::current()->username }}</span>
        </h1>

        <p class="lead admin-description mb-4">
            Selamat datang di dashboard Sistem Peminjaman Alat Olahraga Voli.
        </p>

        <div class="row g-3 justify-content-center mb-4">

            <div class="col-sm-6">
                <div class="admin-card">
                    <small>Username</small>
                    <strong>{{ \App\Models\User::current()->username }}</strong>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="admin-card">
                    <small>Role</small>
                    <strong>Peminjam</strong>
                </div>
            </div>

        </div>

        <a href="{{ url('/peminjam/daftar-alat') }}" class="btn btn-volley btn-lg px-4">
            Lihat Katalog Alat
        </a>

        <p class="text-secondary small mt-4 mb-0">
            Silakan gunakan menu navigasi di samping untuk mengakses fitur sistem.
        </p>

    </div>

</section>

@endsection