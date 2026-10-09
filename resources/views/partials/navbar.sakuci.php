<style>
:root:not(:has(#themeToggle:checked)),
:root:not(:has(#themeToggle:checked)) [data-bs-theme] {
    color-scheme: light;
    --bs-body-color: #212529;
    --bs-body-bg: #f8f9fa;
    --bs-heading-color: #212529;
    --bs-emphasis-color: #000;
    --bs-secondary-color: rgba(33, 37, 41, .75);
    --bs-secondary-bg: #e9ecef;
    --bs-tertiary-bg: #f8f9fa;
    --bs-border-color: #dee2e6;
    --bs-link-color: #0d6efd;
    --bs-link-hover-color: #0a58ca;
}

:root:has(#themeToggle:checked),
:root:has(#themeToggle:checked) [data-bs-theme] {
    color-scheme: dark;
    --bs-body-color: #dee2e6;
    --bs-body-bg: #0f1623;
    --bs-heading-color: #ffffff;
    --bs-emphasis-color: #ffffff;
    --bs-secondary-color: rgba(222, 226, 230, .75);
    --bs-secondary-bg: #1a2232;
    --bs-tertiary-bg: #151d2c;
    --bs-border-color: #2c3a52;
    --bs-link-color: #72aaff;
    --bs-link-hover-color: #8bbcff;
}

html, body { background-color: var(--bs-body-bg) !important; color: var(--bs-body-color); }
.main-content { background-color: var(--bs-body-bg); }

.sidebar-toggle, .theme-checkbox { display: none; }

.sidebar {
    position: fixed; top: 0; left: 0; width: 260px;
    height: 100vh; height: 100dvh;
    overflow-y: auto; scrollbar-width: none;
    padding: 22px 15px; display: flex; flex-direction: column;
    background: #eaf3ff; color: #17324d; z-index: 1000;
    transform: translateX(0); transition: transform .3s ease;
    box-shadow: 4px 0 20px rgba(13, 110, 253, .08);
}
.sidebar::-webkit-scrollbar { display: none; }
.sidebar-toggle:checked ~ .sidebar { transform: translateX(-100%); }

.sidebar-brand {
    display: flex; align-items: center; gap: 12px; padding: 5px 10px 25px;
    color: #17324d; text-decoration: none; font-size: 20px; font-weight: 700;
}
.sidebar-brand:hover { color: #17324d; }

.sidebar-label {
    padding: 0 14px 8px; color: #59738d; font-size: 11px;
    font-weight: 700; letter-spacing: 1.5px;
}

.sidebar-menu { display: flex; flex-direction: column; gap: 6px; }

.sidebar-link {
    width: 100%; min-height: 46px; display: flex; align-items: center; gap: 13px;
    padding: 11px 14px; border: none; border-radius: 11px; background: transparent;
    color: #31506d; text-decoration: none; font-weight: 500; cursor: pointer;
    transition: background .2s ease, color .2s ease, transform .2s ease;
}
.sidebar-link:hover { background: #d6e8ff; color: #0d6efd; transform: translateX(3px); }
.sidebar-link.active {
    background: #cfe2ff; color: #084298; font-weight: 700;
    box-shadow: 0 5px 15px rgba(13, 110, 253, .08);
}

.sidebar-icon {
    width: 26px; flex-shrink: 0; display: flex; align-items: center;
    justify-content: center; font-size: 18px;
}

.sidebar-badge {
    margin-left: auto; min-width: 22px; height: 22px; padding: 0 7px;
    display: inline-flex; align-items: center; justify-content: center;
    border-radius: 50px; background: #dc3545; color: #fff;
    font-size: 12px; font-weight: 700;
    box-shadow: 0 3px 10px rgba(220, 53, 69, .4);
    animation: badgePulse 1.6s ease-in-out infinite;
}
@keyframes badgePulse { 0%,100% { transform: scale(1); } 50% { transform: scale(1.12); } }

.sidebar-user {
    margin-top: auto; padding-top: 15px;
    border-top: 1px solid rgba(13, 110, 253, .15);
}
.sidebar-usercard {
    margin-bottom: 10px; padding: 12px 14px; border-radius: 11px;
    background: #d6e8ff; color: #17324d; font-size: 13px; line-height: 1.5;
}
.sidebar-usercard strong { display: block; font-size: 15px; }

.sidebar-logout {
    justify-content: center; border: 1px solid #dc3545;
    color: #dc3545; font-weight: 600;
}
.sidebar-logout:hover { background: #dc3545; color: #fff; transform: none; }

.sidebar-button {
    position: fixed; top: 18px; left: 275px; width: 44px; height: 44px;
    display: flex; align-items: center; justify-content: center;
    border: none; border-radius: 11px; background: #eaf3ff; color: #0d6efd;
    font-size: 22px; cursor: pointer; z-index: 9998;
    box-shadow: 0 5px 15px rgba(13, 110, 253, .12);
    transition: left .3s ease, background .2s ease, transform .2s ease;
}
.sidebar-button:hover { background: #d6e8ff; transform: translateY(-2px); }
.sidebar-toggle:checked ~ .sidebar-button { left: 18px; }

.main-content { min-height: 100vh; margin-left: 260px; transition: margin-left .3s ease; }
.sidebar-toggle:checked ~ .main-content { margin-left: 0; }

.theme-button {
    position: fixed; top: 18px; right: 20px; width: 54px; height: 54px;
    border-radius: 50%; background: #ffffff; border: none; cursor: pointer;
    z-index: 99999; overflow: hidden;
    box-shadow: 0 0 0 2px rgba(13, 110, 253, .35), 0 8px 20px rgba(0, 0, 0, .15);
    transition: transform .3s ease, box-shadow .3s ease;
}
.theme-button::before {
    content: ""; position: absolute; width: 43px; height: 22px; top: 8px; left: 1px;
    border-top: 4px solid #0d6efd; border-radius: 50%; transform: rotate(35deg);
}
.theme-button::after {
    content: ""; position: absolute; width: 37px; height: 19px; bottom: 7px; right: 0;
    border-bottom: 4px solid #ffc107; border-radius: 50%; transform: rotate(-35deg);
}
.theme-button:hover { transform: rotate(12deg) scale(1.08); }

/* MODE GELAP */
:root:has(#themeToggle:checked) .sidebar { background: #172033; color: #fff; box-shadow: 4px 0 20px rgba(0,0,0,.25); }
:root:has(#themeToggle:checked) .sidebar-brand,
:root:has(#themeToggle:checked) .sidebar-brand:hover { color: #fff; }
:root:has(#themeToggle:checked) .sidebar-link { color: #d7e3f0; }
:root:has(#themeToggle:checked) .sidebar-link:hover { background: #263957; color: #72aaff; }
:root:has(#themeToggle:checked) .sidebar-link.active { background: #29456d; color: #8bbcff; }
:root:has(#themeToggle:checked) .sidebar-label { color: #aebed0; }
:root:has(#themeToggle:checked) .sidebar-usercard { background: #263957; color: #fff; }
:root:has(#themeToggle:checked) .sidebar-logout { color: #ff7b88; border-color: #ff7b88; }
:root:has(#themeToggle:checked) .sidebar-logout:hover { background: #dc3545; color: #fff; }
:root:has(#themeToggle:checked) .sidebar-button { background: #172033; color: #72aaff; }
:root:has(#themeToggle:checked) .theme-button { background: #263957; }

@media (max-width: 991px) {
    .sidebar { width: 270px; transform: translateX(-100%); }
    .sidebar-toggle:checked ~ .sidebar { transform: translateX(0); }
    .sidebar-button { top: 15px; left: 15px; }
    .sidebar-toggle:checked ~ .sidebar-button { left: 15px; }
    .main-content, .sidebar-toggle:checked ~ .main-content { margin-left: 0; }
    .theme-button { top: 15px; right: 15px; width: 50px; height: 50px; }
}
</style>


@php
    $currentUser = \App\Models\User::current();
    $isAdmin   = $currentUser && $currentUser->role === 'admin';
    $isPetugas = $currentUser && $currentUser->role === 'petugas';

    $jumlahPending = 0;

    if ($isAdmin || $isPetugas) {
        try {
            $jumlahPending = count(\App\Models\Peminjaman::where('status', 'Pending')->get());
        } catch (\Throwable $e) {
            $jumlahPending = 0;
        }
    }
@endphp


<input type="checkbox" id="sidebarToggle" class="sidebar-toggle" autocomplete="off">
<input type="checkbox" id="themeToggle" class="theme-checkbox" autocomplete="off">


<aside id="sidebar" class="sidebar">

    <a href="{{ route('home') }}" class="sidebar-brand">
        <span style="font-size: 28px;">🏐</span>
        <span>{{ config('app.name') }}</span>
    </a>

    @if ($currentUser && ! $isAdmin)
        <div class="sidebar-label">MENU NAVIGASI</div>
    @endif

    <nav class="sidebar-menu">

        <a href="{{ route('home') }}"
           class="sidebar-link {{ is_route('home') ? 'active' : '' }}">
            <span class="sidebar-icon">🏠</span>
            <span>Beranda</span>
        </a>

        @if ($currentUser)

            <a href="{{ $isAdmin ? route('admin.dashboard') : route('dashboard') }}"
               class="sidebar-link {{ is_route('admin.dashboard', 'dashboard') ? 'active' : '' }}">
                <span class="sidebar-icon">📊</span>
                <span>Dashboard</span>
            </a>

            @if ($isAdmin)

                {{-- MENU ADMIN --}}

                <a href="{{ route('kategori.index') }}"
                   class="sidebar-link {{ is_route('kategori.index') ? 'active' : '' }}">
                    <span class="sidebar-icon">🗂️</span>
                    <span>Kategori</span>
                </a>

                <a href="{{ route('alat.index') }}"
                   class="sidebar-link {{ is_route('alat.index') ? 'active' : '' }}">
                    <span class="sidebar-icon">🏐</span>
                    <span>Daftar Alat</span>
                </a>

                <a href="{{ route('peminjaman.index') }}"
                   class="sidebar-link {{ is_route('peminjaman.index') ? 'active' : '' }}">
                    <span class="sidebar-icon">📦</span>
                    <span>Peminjaman</span>
                    @if ($jumlahPending > 0)
                        <span class="sidebar-badge">{{ $jumlahPending > 99 ? '99+' : $jumlahPending }}</span>
                    @endif
                </a>

                <a href="{{ route('pengembalian.index') }}"
                   class="sidebar-link {{ is_route('pengembalian.index') ? 'active' : '' }}">
                    <span class="sidebar-icon">🔄</span>
                    <span>Pengembalian</span>
                </a>

                <a href="{{ route('admin.log') }}"
                   class="sidebar-link {{ is_route('admin.log') ? 'active' : '' }}">
                    <span class="sidebar-icon">📜</span>
                    <span>Log Aktivitas</span>
                </a>

            @elseif ($isPetugas)

                {{-- MENU PETUGAS --}}

                <a href="{{ route('petugas.persetujuan') }}"
                   class="sidebar-link {{ is_route('petugas.persetujuan') ? 'active' : '' }}">
                    <span class="sidebar-icon">✅</span>
                    <span>Persetujuan</span>
                    @if ($jumlahPending > 0)
                        <span class="sidebar-badge">{{ $jumlahPending > 99 ? '99+' : $jumlahPending }}</span>
                    @endif
                </a>

                <a href="{{ route('petugas.pemantauan') }}"
                   class="sidebar-link {{ is_route('petugas.pemantauan') ? 'active' : '' }}">
                    <span class="sidebar-icon">🔍</span>
                    <span>Pemantauan</span>
                </a>

                <a href="{{ route('petugas.laporan') }}"
                   class="sidebar-link {{ is_route('petugas.laporan') ? 'active' : '' }}">
                    <span class="sidebar-icon">🖨️</span>
                    <span>Laporan</span>
                </a>

            @else

                {{-- MENU PEMINJAM --}}

                <a href="{{ route('alat.katalog') }}"
                   class="sidebar-link {{ is_route('alat.katalog') ? 'active' : '' }}">
                    <span class="sidebar-icon">🏐</span>
                    <span>Katalog Alat</span>
                </a>

                <a href="{{ route('peminjam.riwayat') }}"
                   class="sidebar-link {{ is_route('peminjam.riwayat') ? 'active' : '' }}">
                    <span class="sidebar-icon">🕘</span>
                    <span>Riwayat Peminjaman</span>
                </a>

                <a href="{{ route('peminjam.pengembalian') }}"
                   class="sidebar-link {{ is_route('peminjam.pengembalian') ? 'active' : '' }}">
                    <span class="sidebar-icon">↩️</span>
                    <span>Pengembalian Alat</span>
                </a>

            @endif

        @endif

    </nav>

    @if ($currentUser)
        <div class="sidebar-user">

            <div class="sidebar-usercard">
                <strong>{{ $currentUser->username }}</strong>
                {{ ucfirst($currentUser->role) }}
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link sidebar-logout">
                    <span>🚪 Logout</span>
                </button>
            </form>

        </div>
    @endif

</aside>


<label for="sidebarToggle" class="sidebar-button"
       aria-label="Buka atau tutup sidebar"
       title="Buka atau tutup sidebar">
    ☰
</label>


<label for="themeToggle" class="theme-button"
       aria-label="Ganti mode terang atau gelap"
       title="Ganti mode terang atau gelap"></label>