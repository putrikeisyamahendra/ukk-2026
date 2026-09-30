<style>
/* =========================================================
   SIDEBAR
   ========================================================= */

.sidebar-toggle {
    display: none;
}


/* =========================================================
   SIDEBAR
   ========================================================= */

.sidebar {
    position: fixed;

    top: 0;
    left: 0;

    width: 260px;
    height: 100vh;

    padding: 22px 15px;

    display: flex;
    flex-direction: column;

    background: #eaf3ff;
    color: #17324d;

    z-index: 1000;

    transform: translateX(0);

    transition:
        transform .3s ease;

    box-shadow:
        4px 0 20px rgba(13, 110, 253, .08);
}


/* =========================================================
   SIDEBAR TUTUP
   ========================================================= */

.sidebar-toggle:checked ~ .sidebar {
    transform: translateX(-100%);
}


/* =========================================================
   BRAND
   ========================================================= */

.sidebar-brand {
    display: flex;

    align-items: center;

    gap: 12px;

    padding: 5px 10px 25px;

    color: #17324d;

    text-decoration: none;

    font-size: 20px;

    font-weight: 700;
}

.sidebar-brand:hover {
    color: #17324d;
}


/* =========================================================
   MENU
   ========================================================= */

.sidebar-menu {
    display: flex;

    flex-direction: column;

    gap: 6px;
}


/* =========================================================
   LINK
   ========================================================= */

.sidebar-link {
    width: 100%;

    min-height: 46px;

    display: flex;

    align-items: center;

    gap: 13px;

    padding: 11px 14px;

    border: none;

    border-radius: 11px;

    background: transparent;

    color: #31506d;

    text-decoration: none;

    font-weight: 500;

    cursor: pointer;

    transition:
        background .2s ease,
        color .2s ease,
        transform .2s ease;
}


.sidebar-link:hover {
    background: #d6e8ff;

    color: #0d6efd;

    transform: translateX(3px);
}


.sidebar-link.active {
    background: #cfe2ff;

    color: #084298;

    font-weight: 700;

    box-shadow:
        0 5px 15px rgba(13, 110, 253, .08);
}


/* =========================================================
   ICON
   ========================================================= */

.sidebar-icon {
    width: 26px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 18px;
}


/* =========================================================
   USER
   ========================================================= */

.sidebar-user {
    margin-top: auto;

    padding-top: 15px;

    border-top:
        1px solid rgba(13, 110, 253, .15);
}


.sidebar-username {
    padding: 5px 14px 10px;

    color: #59738d;

    font-size: 13px;
}


/* =========================================================
   TOMBOL SIDEBAR
   ========================================================= */

.sidebar-button {
    position: fixed;

    top: 18px;
    left: 275px;

    width: 44px;
    height: 44px;

    display: flex;

    align-items: center;
    justify-content: center;

    border: none;

    border-radius: 11px;

    background: #eaf3ff;

    color: #0d6efd;

    font-size: 22px;

    cursor: pointer;

    z-index: 9998;

    box-shadow:
        0 5px 15px rgba(13, 110, 253, .12);

    transition:
        left .3s ease,
        background .2s ease,
        transform .2s ease;
}


.sidebar-button:hover {
    background: #d6e8ff;

    transform: translateY(-2px);
}


/* TOMBOL IKUT BERGESER */

.sidebar-toggle:checked ~ .sidebar-button {
    left: 18px;
}


/* =========================================================
   MAIN CONTENT
   ========================================================= */

.main-content {
    min-height: 100vh;

    margin-left: 260px;

    transition:
        margin-left .3s ease;
}


/* SIDEBAR DITUTUP → CONTENT IKUT GESER */

.sidebar-toggle:checked ~ .main-content {
    margin-left: 0;
}


/* =========================================================
   THEME BUTTON
   ========================================================= */

.theme-button {
    position: fixed;

    top: 18px;
    right: 20px;

    width: 54px;
    height: 54px;

    border-radius: 50%;

    background: var(--bs-body-bg);

    border:
        4px solid var(--bs-heading-color);

    cursor: pointer;

    z-index: 99999;

    overflow: hidden;

    box-shadow:
        0 8px 20px rgba(0, 0, 0, .15);

    transition:
        transform .3s ease,
        box-shadow .3s ease;
}


.theme-button::before {
    content: "";

    position: absolute;

    width: 43px;
    height: 22px;

    top: 8px;
    left: 1px;

    border-top:
        4px solid #0d6efd;

    border-radius: 50%;

    transform: rotate(35deg);
}


.theme-button::after {
    content: "";

    position: absolute;

    width: 37px;
    height: 19px;

    bottom: 7px;
    right: 0;

    border-bottom:
        4px solid #ffc107;

    border-radius: 50%;

    transform: rotate(-35deg);
}


.theme-button:hover {
    transform:
        rotate(12deg)
        scale(1.08);

    box-shadow:
        0 10px 25px rgba(13, 110, 253, .18);
}


/* =========================================================
   DARK MODE
   ========================================================= */

[data-bs-theme="dark"] .sidebar {
    background: #172033;

    color: #fff;

    box-shadow:
        4px 0 20px rgba(0,0,0,.25);
}


[data-bs-theme="dark"] .sidebar-brand {
    color: #fff;
}


[data-bs-theme="dark"] .sidebar-brand:hover {
    color: #fff;
}


[data-bs-theme="dark"] .sidebar-link {
    color: #d7e3f0;
}


[data-bs-theme="dark"] .sidebar-link:hover {
    background: #263957;

    color: #72aaff;
}


[data-bs-theme="dark"] .sidebar-link.active {
    background: #29456d;

    color: #8bbcff;
}


[data-bs-theme="dark"] .sidebar-username {
    color: #aebed0;
}


[data-bs-theme="dark"] .sidebar-button {
    background: #172033;

    color: #72aaff;
}


[data-bs-theme="dark"] .theme-button {
    background: #172033;

    border-color: #fff;
}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 991px) {

    .sidebar {
        width: 270px;

        transform: translateX(-100%);
    }


    /*
     * MOBILE:
     * checkbox dicentang = sidebar muncul
     */

    .sidebar-toggle:checked ~ .sidebar {
        transform: translateX(0);
    }


    .sidebar-button {
        top: 15px;

        left: 15px;
    }


    .sidebar-toggle:checked ~ .sidebar-button {
        left: 15px;
    }


    /*
     * Mobile tidak menggeser halaman.
     * Sidebar berada di atas halaman.
     */

    .main-content,
    .sidebar-toggle:checked ~ .main-content {
        margin-left: 0;
    }


    .theme-button {
        top: 15px;
        right: 15px;

        width: 50px;
        height: 50px;
    }

}
</style>


@php
    $currentUser = \App\Models\User::current();
@endphp


{{-- =========================================================
     CHECKBOX CONTROL
     Tidak membutuhkan JavaScript
========================================================= --}}

<input
    type="checkbox"
    id="sidebarToggle"
    class="sidebar-toggle"
>


{{-- =========================================================
     SIDEBAR
========================================================= --}}

<aside
    id="sidebar"
    class="sidebar"
>

    {{-- BRAND --}}

    <a
        href="{{ route('home') }}"
        class="sidebar-brand"
    >

        <span style="font-size: 28px;">
            🏐
        </span>

        <span>
            {{ config('app.name') }}
        </span>

    </a>


    {{-- MENU --}}

    <nav class="sidebar-menu">

        {{-- BERANDA --}}

        <a
            href="{{ route('home') }}"
            class="sidebar-link
            {{ is_route('home') ? 'active' : '' }}"
        >

            <span class="sidebar-icon">
                🏠
            </span>

            <span>
                Beranda
            </span>

        </a>


        @if ($currentUser)

            {{-- DASHBOARD --}}

            <a
                href="{{ $currentUser->role === 'admin'
                    ? route('admin.dashboard')
                    : route('dashboard') }}"
                class="sidebar-link
                {{ is_route('admin.dashboard', 'dashboard')
                    ? 'active'
                    : '' }}"
            >

                <span class="sidebar-icon">
                    📊
                </span>

                <span>
                    Dashboard
                </span>

            </a>


            {{-- KATEGORI --}}

            <a
                href="{{ route('kategori.index') }}"
                class="sidebar-link
                {{ is_route('kategori.index')
                    ? 'active'
                    : '' }}"
            >

                <span class="sidebar-icon">
                    🗂️
                </span>

                <span>
                    Kategori
                </span>

            </a>


            {{-- DAFTAR ALAT --}}

            <a
                href="{{ route('alat.index') }}"
                class="sidebar-link
                {{ is_route('alat.index')
                    ? 'active'
                    : '' }}"
            >

                <span class="sidebar-icon">
                    🏐
                </span>

                <span>
                    Daftar Alat
                </span>

            </a>


            {{-- PEMINJAMAN --}}

            <a
                href="{{ route('peminjaman.index') }}"
                class="sidebar-link
                {{ is_route('peminjaman.index')
                    ? 'active'
                    : '' }}"
            >

                <span class="sidebar-icon">
                    📦
                </span>

                <span>
                    Peminjaman
                </span>

            </a>


            {{-- PENGEMBALIAN --}}

            <a
                href="{{ route('pengembalian.index') }}"
                class="sidebar-link
                {{ is_route('pengembalian.index')
                    ? 'active'
                    : '' }}"
            >

                <span class="sidebar-icon">
                    🔄
                </span>

                <span>
                    Pengembalian
                </span>

            </a>

        @endif

    </nav>


    {{-- USER --}}

    @if ($currentUser)

        <div class="sidebar-user">

            <div class="sidebar-username">
                👤 {{ $currentUser->username }}
            </div>


            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="sidebar-link"
                >

                    <span class="sidebar-icon">
                        🚪
                    </span>

                    <span>
                        Logout
                    </span>

                </button>

            </form>

        </div>

    @endif

</aside>


{{-- =========================================================
     TOMBOL SIDEBAR
========================================================= --}}

<label
    for="sidebarToggle"
    class="sidebar-button"
    aria-label="Buka atau tutup sidebar"
    title="Buka atau tutup sidebar"
>

    ☰

</label>
