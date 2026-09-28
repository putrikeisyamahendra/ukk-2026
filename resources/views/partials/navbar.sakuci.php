<style>
    /* Warna semua tulisan menu */
    .navbar .nav-link {
        color: #0d6efd !important;
    }

    /* Warna saat mouse diarahkan */
    .navbar .nav-link:hover {
        color: #0a58ca !important;
    }

    /* Menu yang sedang aktif */
    .navbar .nav-link.active {
        color: #0d6efd !important;
        text-decoration-color: #0d6efd !important;
        border-color: #0d6efd !important;
    }

    /* Kalau garis bawah berasal dari pseudo-element */
    .navbar .nav-link.active::after {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
    }
</style>


<nav class="navbar navbar-expand-lg bg-body border-bottom sticky-top">
    <div class="container">
        <div class="d-flex align-items-center gap-2">
            @php
                $dbConnected = false;
                try {
                    \Sakuci\Database\Connection::pdo();
                    $dbConnected = true;
                } catch (\Throwable $e) {
                    $dbConnected = false;
                }
            @endphp

            <button id="themeToggle" type="button" class="logo-toggle"
                    aria-label="Ganti tema terang/gelap (status database: {{ $dbConnected ? 'terhubung' : 'tidak terhubung' }})"
                    title="Ganti tema terang/gelap">
                <svg width="28" height="28" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" style="display: block;" aria-hidden="true">
                    <circle class="logo-ring" cx="16" cy="16" r="15"/>
                    <circle cx="16" cy="16" r="9" fill="{{ $dbConnected ? '#28a745' : '#dc3545' }}"/>
                </svg>
            </button>

            <a class="navbar-brand fw-semibold m-0" href="{{ route('home') }}">
                {{ config('app.name') }}
            </a>
        </div>

        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#menuUtama"
                aria-controls="menuUtama" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuUtama">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">

                <li class="nav-item">
                    <a class="nav-link text-primary {{ is_route('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">
                        Beranda
                    </a>
                </li>

                @php
                    $currentUser = \App\Models\User::current();
                @endphp

                @if ($currentUser)

                    <li class="nav-item">
                        <a class="nav-link text-primary {{ is_route('admin.dashboard', 'dashboard') ? 'active' : '' }}"
                           href="{{ $currentUser->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary {{ is_route('kategori.index') ? 'active' : '' }}"
                           href="{{ route('kategori.index') }}">Kategori</a>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary {{ is_route('alat.index') ? 'active' : '' }}"
                           href="{{ route('alat.index') }}">
                            Daftar Alat
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary {{ is_route('peminjaman.index') ? 'active' : '' }}"
                           href="{{ route('peminjaman.index') }}">
                            Peminjaman
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary {{ is_route('pengembalian.index') ? 'active' : '' }}"
                           href="{{ route('pengembalian.index') }}">
                            Pengembalian
                        </a>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-lg-inline">
                            @csrf
                            <button type="submit"
                                    class="btn btn-sm btn-outline-secondary w-100 mt-2 mt-lg-0">
                                Logout ({{ $currentUser->username }})
                            </button>
                        </form>
                    </li>

                @else
                    ...
                @endif

            </ul>
        </div>
    </div>
</nav>
