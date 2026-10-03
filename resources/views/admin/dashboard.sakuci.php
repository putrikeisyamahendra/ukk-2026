@extends('layouts.app')

@section('title', 'Admin')

@section('content')

<style>
/* Hilangkan scrollbar browser di belakang hero */
html:has(.admin-hero),
html:has(.admin-hero) body {
    overflow: hidden;
}

/* Full screen, ikut bergeser saat sidebar dibuka/ditutup */
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

/* margin:auto = di tengah, tapi tetap bisa di-scroll kalau layar pendek */
.admin-content {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 900px;
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

/* Judul Kategori Section */
.section-subtitle {
    font-size: 18px;
    font-weight: 700;
    color: var(--bs-heading-color);
    text-align: left;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.section-subtitle::before {
    content: "";
    display: inline-block;
    width: 4px;
    height: 18px;
    background: #0d6efd;
    border-radius: 4px;
}

/* Menu admin */
.admin-menu {
    margin: 25px auto 0;
    max-width: 850px;
}

.admin-card {
    display: flex;
    flex-direction: column;
    height: 100%;
    padding: 22px;
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
    width: 46px;
    height: 46px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    border-radius: 14px;
    background: linear-gradient(135deg, #0d6efd, #084298);
    color: #fff;
    font-size: 20px;
    box-shadow: 0 6px 15px rgba(13, 110, 253, 0.20);
}

.admin-card h2 {
    color: var(--bs-heading-color);
}

.admin-card p {
    color: var(--bs-secondary-color);
}

/* Bola voli */
.volleyball {
    position: fixed;
    width: 105px;
    height: 105px;
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

/* Posisi bola mengikuti tepi hero */
.ball-one {
    top: 12%;
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
    }

    .ball-two {
        bottom: 6%;
        right: 4%;
    }
}
</style>

<section class="admin-hero">

    {{-- Bola voli dekorasi --}}
    <div class="volleyball ball-one"></div>
    <div class="volleyball ball-two"></div>

    <div class="admin-content">

        <span class="badge rounded-pill badge-admin px-4 py-2 mb-4">
            🏐 AREA ADMIN
        </span>

        <div class="admin-line"></div>

        <h1 class="display-5 fw-bold mb-3 admin-title">
            Halo,
            <span class="text-admin">{{ $user->username ?? 'Admin' }}</span>
        </h1>

        <p class="lead admin-description mx-auto mb-4" style="max-width: 650px;">
            Selamat datang di panel administrasi
            Sistem Peminjaman Alat Olahraga Voli.
        </p>


        {{-- MENU UTAMA --}}
        <div class="admin-menu mb-4">
            <h3 class="section-subtitle">Menu Utama</h3>
            <div class="row g-3">

                {{-- Daftar Alat Voli --}}
                <div class="col-md-6 col-lg-3">
                    <a href="{{ url('/admin/alat') }}" class="admin-card">
                        <div class="admin-icon">🏐</div>
                        <h2 class="h6 fw-bold mb-2">Daftar Alat Voli</h2>
                        <p class="small mb-0">
                            Kelola data bola, net, dan perlengkapan.
                        </p>
                    </a>
                </div>

                {{-- Kategori Alat --}}
                <div class="col-md-6 col-lg-3">
                    <a href="{{ url('/admin/kategori') }}" class="admin-card">
                        <div class="admin-icon">🏷️</div>
                        <h2 class="h6 fw-bold mb-2">Kategori Alat</h2>
                        <p class="small mb-0">
                            Pengelompokan jenis peralatan voli.
                        </p>
                    </a>
                </div>

                {{-- Peminjaman & Persetujuan --}}
                <div class="col-md-6 col-lg-3">
                    <a href="{{ url('/admin/peminjaman') }}" class="admin-card">
                        <div class="admin-icon">📋</div>
                        <h2 class="h6 fw-bold mb-2">Persetujuan</h2>
                        <p class="small mb-0">
                            Verifikasi pengajuan peminjaman user.
                        </p>
                    </a>
                </div>

                {{-- Log Aktivitas --}}
                <div class="col-md-6 col-lg-3">
                    <a href="{{ url('/admin/log-aktivitas') }}" class="admin-card">
                        <div class="admin-icon">📜</div>
                        <h2 class="h6 fw-bold mb-2">Log Aktivitas</h2>
                        <p class="small mb-0">
                            Lihat riwayat aktivitas tindakan sistem.
                        </p>
                    </a>
                </div>

            </div>
        </div>


        {{-- SISTEM ADMIN --}}
        <div class="admin-menu">
            <h3 class="section-subtitle">Sistem Admin</h3>
            <div class="row g-3">

                {{-- Manage Role --}}
                <div class="col-md-4">
                    <a href="{{ route('admin.roles.index') }}" class="admin-card">
                        <div class="admin-icon">👥</div>
                        <h2 class="h6 fw-bold mb-2">Manage Role</h2>
                        <p class="small mb-0">
                            Tambah role baru untuk dipakai saat membuat user.
                        </p>
                    </a>
                </div>

                {{-- Manage User --}}
                <div class="col-md-4">
                    <a href="{{ route('admin.users.index') }}" class="admin-card">
                        <div class="admin-icon">👤</div>
                        <h2 class="h6 fw-bold mb-2">Manage User</h2>
                        <p class="small mb-0">
                            Tambah user baru dan tentukan role-nya.
                        </p>
                    </a>
                </div>

                {{-- Download Database --}}
                <div class="col-md-4">
                    <a href="{{ route('admin.database.export') }}" class="admin-card">
                        <div class="admin-icon">💾</div>
                        <h2 class="h6 fw-bold mb-2">Download Database</h2>
                        <p class="small mb-0">
                            Unduh seluruh isi database menjadi file .sql.
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

@endsection