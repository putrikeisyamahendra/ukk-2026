@extends('layouts.app')

@section('title', 'Admin')

@section('content')

<style>
html:has(.admin-hero),
html:has(.admin-hero) body { overflow: hidden; }

.admin-hero {
    position: fixed; top: 0; right: 0; bottom: 0; left: 260px; z-index: 1;
    display: flex; overflow-x: hidden; overflow-y: auto; scrollbar-width: none;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    color: var(--bs-body-color);
    transition: left .3s ease;
}
.admin-hero::-webkit-scrollbar { display: none; }
:root:has(#sidebarToggle:checked) .admin-hero { left: 0; }

.admin-hero::before {
    content: ""; position: fixed; width: 420px; height: 420px;
    background: rgba(13,110,253,.08); border-radius: 50%;
    top: -180px; left: -130px; pointer-events: none;
}
.admin-hero::after {
    content: ""; position: fixed; width: 330px; height: 330px;
    background: rgba(255,193,7,.10); border-radius: 50%;
    bottom: -160px; right: -100px; pointer-events: none;
}

.admin-content {
    position: relative; z-index: 2; width: 100%; max-width: 960px;
    margin: auto; text-align: center; padding: 80px 20px 40px;
}

/* CARD SAMBUTAN */
.admin-welcome {
    max-width: none;
    margin: 0 0 28px;
    padding: 36px 30px;
    border-radius: 22px;
    background: linear-gradient(135deg, rgba(13,110,253,.10), rgba(255,193,7,.10));
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0,0,0,.08);
}

.badge-admin {
    background: linear-gradient(135deg, #0d6efd, #084298); color: #fff;
    font-weight: 600; box-shadow: 0 6px 18px rgba(13,110,253,.25);
}
.admin-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.text-admin {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.admin-description { color: var(--bs-secondary-color); line-height: 1.8; }
.admin-line {
    width: 65px; height: 4px; margin: 0 auto 22px; border-radius: 10px;
    background: linear-gradient(90deg, #0d6efd, #ffc107);
}

.admin-stat {
    display: flex; align-items: center; gap: 14px; padding: 16px 20px;
    border-radius: 16px; background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 6px 18px rgba(0,0,0,.06); text-align: left;
}
.admin-stat-icon {
    width: 44px; height: 44px; border-radius: 13px; display: flex;
    align-items: center; justify-content: center; font-size: 20px;
    background: linear-gradient(135deg, #ffc107, #ffda44);
}
.admin-stat small {
    display: block; color: var(--bs-secondary-color); font-size: 11px;
    font-weight: 700; letter-spacing: 1px; text-transform: uppercase;
}
.admin-stat strong { color: #0d6efd; font-size: 24px; line-height: 1.1; }

.section-subtitle {
    font-size: 18px; font-weight: 700; color: var(--bs-heading-color);
    text-align: left; margin-bottom: 15px; display: flex; align-items: center; gap: 8px;
}
.section-subtitle::before {
    content: ""; width: 4px; height: 18px; background: #0d6efd; border-radius: 4px;
}

.admin-menu { margin: 25px auto 0; }
.admin-card {
    display: flex; flex-direction: column; height: 100%; padding: 22px;
    border-radius: 16px; background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color); color: var(--bs-body-color);
    text-decoration: none; box-shadow: 0 6px 18px rgba(0,0,0,.06); transition: all .3s ease;
}
.admin-card:hover {
    transform: translateY(-5px); border-color: #0d6efd;
    box-shadow: 0 12px 25px rgba(13,110,253,.15); color: var(--bs-body-color);
}
.admin-icon {
    width: 46px; height: 46px; display: flex; align-items: center; justify-content: center;
    margin: 0 auto 12px; border-radius: 14px;
    background: linear-gradient(135deg, #0d6efd, #084298); color: #fff; font-size: 20px;
    box-shadow: 0 6px 15px rgba(13,110,253,.20);
}
.admin-card h2 { color: var(--bs-heading-color); }
.admin-card p { color: var(--bs-secondary-color); }

.volleyball {
    position: fixed; width: 95px; height: 95px; border-radius: 50%;
    background: var(--bs-tertiary-bg); border: none;
    box-shadow: 0 12px 28px rgba(0,0,0,.15); z-index: 1; opacity: .95; pointer-events: none;
}
.volleyball::before {
    content: ""; position: absolute; width: 76px; height: 38px;
    border-top: 6px solid #0d6efd; border-radius: 50%; top: 15px; left: 5px; transform: rotate(35deg);
}
.volleyball::after {
    content: ""; position: absolute; width: 62px; height: 31px;
    border-bottom: 6px solid #ffc107; border-radius: 50%; bottom: 15px; right: 5px; transform: rotate(-35deg);
}
.ball-one {
    top: 12%; left: calc(260px + 5%);
    animation: floating 4s ease-in-out infinite; transition: left .3s ease;
}
:root:has(#sidebarToggle:checked) .ball-one { left: 5%; }
.ball-two {
    bottom: 10%; right: 6%; width: 70px; height: 70px;
    animation: floating 5s ease-in-out infinite reverse;
}
.ball-two::before { width: 56px; height: 28px; border-width: 4px; }
.ball-two::after { width: 46px; height: 23px; border-width: 4px; }

@keyframes floating {
    0%,100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(8deg); }
}

@media (max-width: 991px) {
    .admin-hero, :root:has(#sidebarToggle:checked) .admin-hero { left: 0; }
    .ball-one, :root:has(#sidebarToggle:checked) .ball-one { left: 4%; }
}
@media (max-width: 768px) {
    .admin-content { padding: 80px 15px 30px; }
    .admin-welcome { padding: 24px 18px; }
    .volleyball { display: none; }
}
</style>

<section class="admin-hero">

    <div class="volleyball ball-one"></div>
    <div class="volleyball ball-two"></div>

    <div class="admin-content">

        {{-- CARD SAMBUTAN --}}
        <div class="admin-welcome">

            <span class="badge rounded-pill badge-admin px-4 py-2 mb-4">
                🏐 AREA ADMIN
            </span>

            <div class="admin-line"></div>

            <h1 class="display-5 fw-bold mb-3 admin-title">
                Halo,
                <span class="text-admin">{{ $user->username ?? 'Admin' }}</span>
            </h1>

            <p class="lead admin-description mx-auto mb-0" style="max-width: 520px;">
                Selamat datang di panel administrasi
                Sistem Peminjaman Alat Olahraga Voli.
            </p>

        </div>

        {{-- RINGKASAN --}}
        <div class="row g-3 mb-2">
            <div class="col-md-4">
                <div class="admin-stat">
                    <div class="admin-stat-icon">⏳</div>
                    <div><small>Menunggu</small><strong>{{ $menunggu ?? 0 }}</strong></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="admin-stat">
                    <div class="admin-stat-icon">📦</div>
                    <div><small>Sedang dipinjam</small><strong>{{ $dipinjam ?? 0 }}</strong></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="admin-stat">
                    <div class="admin-stat-icon">📜</div>
                    <div><small>Log tercatat</small><strong>{{ $totalLog ?? 0 }}</strong></div>
                </div>
            </div>
        </div>

        {{-- MENU UTAMA --}}
        <div class="admin-menu">
            <h3 class="section-subtitle">Menu Utama</h3>
            <div class="row g-3">

                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('alat.index') }}" class="admin-card">
                        <div class="admin-icon">🏐</div>
                        <h2 class="h6 fw-bold mb-2">Daftar Alat Voli</h2>
                        <p class="small mb-0">Kelola data bola, net, dan perlengkapan.</p>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('kategori.index') }}" class="admin-card">
                        <div class="admin-icon">🏷️</div>
                        <h2 class="h6 fw-bold mb-2">Kategori Alat</h2>
                        <p class="small mb-0">Pengelompokan jenis peralatan voli.</p>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('peminjaman.index') }}" class="admin-card">
                        <div class="admin-icon">📋</div>
                        <h2 class="h6 fw-bold mb-2">Peminjaman</h2>
                        <p class="small mb-0">Kelola data pengajuan dan peminjaman.</p>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('pengembalian.index') }}" class="admin-card">
                        <div class="admin-icon">🔄</div>
                        <h2 class="h6 fw-bold mb-2">Pengembalian</h2>
                        <p class="small mb-0">Catat dan kelola pengembalian alat.</p>
                    </a>
                </div>

            </div>
        </div>

        {{-- SISTEM ADMIN --}}
        <div class="admin-menu">
            <h3 class="section-subtitle">Sistem Admin</h3>
            <div class="row g-3">

                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('admin.log') }}" class="admin-card">
                        <div class="admin-icon">📜</div>
                        <h2 class="h6 fw-bold mb-2">Log Aktivitas</h2>
                        <p class="small mb-0">Riwayat tindakan di sistem.</p>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('admin.roles.index') }}" class="admin-card">
                        <div class="admin-icon">👥</div>
                        <h2 class="h6 fw-bold mb-2">Manage Role</h2>
                        <p class="small mb-0">Tambah role baru untuk membuat user.</p>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('admin.users.index') }}" class="admin-card">
                        <div class="admin-icon">👤</div>
                        <h2 class="h6 fw-bold mb-2">Manage User</h2>
                        <p class="small mb-0">Tambah user baru dan tentukan role-nya.</p>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('admin.database.export') }}" class="admin-card">
                        <div class="admin-icon">💾</div>
                        <h2 class="h6 fw-bold mb-2">Download Database</h2>
                        <p class="small mb-0">Unduh isi database jadi file .sql.</p>
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