@extends('layouts.app')

@section('title', 'Manage Role')

@section('content')

<style>

/* =========================================================
   VOLLEYBALL THEME
   ========================================================= */

.role-page {
    position: relative;
}


/* =========================================================
   HEADER
   ========================================================= */

.role-hero {
    position: relative;
    min-height: 220px;

    display: flex;
    align-items: center;

    overflow: hidden;

    border-radius: 24px;

    background: linear-gradient(
        135deg,
        var(--bs-body-bg),
        var(--bs-secondary-bg)
    );

    color: var(--bs-body-color);
}

.role-hero::before {
    content: "";

    position: absolute;

    width: 420px;
    height: 420px;

    background: rgba(13, 110, 253, 0.08);

    border-radius: 50%;

    top: -180px;
    left: -130px;
}

.role-hero::after {
    content: "";

    position: absolute;

    width: 330px;
    height: 330px;

    background: rgba(255, 193, 7, 0.10);

    border-radius: 50%;

    bottom: -160px;
    right: -100px;
}


.role-content {
    position: relative;

    z-index: 2;

    width: 100%;

    padding: 35px 30px;
}


/* =========================================================
   BADGE
   ========================================================= */

.badge-volley {
    background: linear-gradient(
        135deg,
        #0d6efd,
        #084298
    );

    color: #fff;

    font-weight: 600;

    box-shadow:
        0 6px 18px rgba(13, 110, 253, 0.25);
}


/* =========================================================
   TITLE
   ========================================================= */

.role-title {
    color: var(--bs-heading-color);

    letter-spacing: -1px;
}

.text-volley {
    background: linear-gradient(
        90deg,
        #0d6efd,
        #084298
    );

    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

    background-clip: text;
}

.role-description {
    color: var(--bs-secondary-color);

    line-height: 1.8;
}


/* =========================================================
   LINE
   ========================================================= */

.volley-line {
    width: 65px;
    height: 4px;

    margin: 0 0 22px;

    border-radius: 10px;

    background: linear-gradient(
        90deg,
        #0d6efd,
        #ffc107
    );
}


/* =========================================================
   GLASS CARD
   ========================================================= */

.role-card {
    border-radius: 20px;

    background: color-mix(
        in srgb,
        var(--bs-body-bg) 85%,
        transparent
    );

    border: 1px solid var(--bs-border-color);

    box-shadow:
        0 12px 35px rgba(0, 0, 0, 0.08);

    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);

    overflow: hidden;
}

.role-card-header {
    padding: 20px;

    background: color-mix(
        in srgb,
        var(--bs-body-bg) 70%,
        transparent
    );

    border-bottom: 1px solid var(--bs-border-color);
}

.role-card-body {
    padding: 24px;
}


/* =========================================================
   INPUT
   ========================================================= */

.form-control {
    border-radius: 10px;

    background: color-mix(
        in srgb,
        var(--bs-body-bg) 75%,
        transparent
    );
}

.form-control:focus {
    border-color: #0d6efd;

    box-shadow:
        0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}


/* =========================================================
   BUTTON BLUE
   SAMA SEPERTI BUTTON VOLLEYBALL AWAL
   ========================================================= */

.btn-volley {
    border: none;

    border-radius: 12px;

    font-weight: 700;

    color: #fff;

    background: linear-gradient(
        135deg,
        #0d6efd,
        #084298
    );

    box-shadow:
        0 7px 18px rgba(13, 110, 253, 0.22);

    transition:
        all 0.3s ease;
}

.btn-volley:hover {
    color: #fff;

    transform: translateY(-3px);

    box-shadow:
        0 11px 25px rgba(13, 110, 253, 0.32);
}


/* =========================================================
   BUTTON YELLOW
   SAMA SEPERTI BUTTON VOLLEYBALL AWAL
   ========================================================= */

.btn-volley-yellow {
    border: none;

    border-radius: 12px;

    font-weight: 700;

    color: #102a43;

    background: linear-gradient(
        135deg,
        #ffc107,
        #ffda44
    );

    box-shadow:
        0 7px 18px rgba(255, 193, 7, 0.22);

    transition:
        all 0.3s ease;
}

.btn-volley-yellow:hover {
    color: #102a43;

    transform: translateY(-3px);

    box-shadow:
        0 11px 25px rgba(255, 193, 7, 0.32);
}


/* =========================================================
   BACK BUTTON
   ========================================================= */

.btn-back {
    border-radius: 12px;

    font-weight: 600;
}


/* =========================================================
   TABLE
   ========================================================= */

.role-table {
    color: var(--bs-body-color);

    vertical-align: middle;
}

.role-table thead th {
    color: var(--bs-secondary-color);

    background: color-mix(
        in srgb,
        var(--bs-body-bg) 50%,
        transparent
    );

    border-bottom:
        1px solid var(--bs-border-color);

    font-size: 0.85rem;
}

.role-table tbody tr {
    background: transparent;

    transition:
        background-color 0.3s ease;
}

.role-table tbody tr:hover {
    background:
        rgba(13, 110, 253, 0.05);
}

.role-name {
    color: #0d6efd;

    font-weight: 600;
}


/* =========================================================
   STATUS BADGE
   ========================================================= */

.badge-open {
    background: #198754;

    color: #fff;
}

.badge-closed {
    background: #6c757d;

    color: #fff;
}


/* =========================================================
   VOLLEYBALL DECORATION
   ========================================================= */

.volleyball {
    position: absolute;

    width: 85px;
    height: 85px;

    border-radius: 50%;

    background: var(--bs-body-bg);

    border:
        4px solid var(--bs-heading-color);

    box-shadow:
        0 12px 28px rgba(0, 0, 0, 0.15);

    z-index: 1;

    opacity: 0.95;
}

.volleyball::before {
    content: "";

    position: absolute;

    width: 68px;
    height: 34px;

    border-top:
        5px solid #0d6efd;

    border-radius: 50%;

    top: 14px;
    left: 4px;

    transform:
        rotate(35deg);
}

.volleyball::after {
    content: "";

    position: absolute;

    width: 56px;
    height: 28px;

    border-bottom:
        5px solid #ffc107;

    border-radius: 50%;

    bottom: 14px;
    right: 4px;

    transform:
        rotate(-35deg);
}

.ball-one {
    top: 20px;
    right: 12%;

    animation:
        floating 4s ease-in-out infinite;
}

.ball-two {
    bottom: 20px;
    left: 8%;

    width: 60px;
    height: 60px;

    animation:
        floating 5s ease-in-out infinite reverse;
}

.ball-two::before {
    width: 48px;
    height: 24px;

    border-width: 4px;
}

.ball-two::after {
    width: 40px;
    height: 20px;

    border-width: 4px;
}


/* =========================================================
   ANIMATION
   ========================================================= */

@keyframes floating {

    0%,
    100% {
        transform:
            translateY(0)
            rotate(0deg);
    }

    50% {
        transform:
            translateY(-15px)
            rotate(8deg);
    }
}


/* =========================================================
   DARK MODE
   ========================================================= */

[data-bs-theme="dark"] .role-hero {
    background: linear-gradient(
        135deg,
        var(--bs-body-bg),
        #172033
    );
}

[data-bs-theme="dark"] .role-card {
    background:
        rgba(255, 255, 255, 0.05);

    box-shadow:
        0 12px 35px rgba(0, 0, 0, 0.30);
}

[data-bs-theme="dark"] .role-card-header {
    background:
        rgba(255, 255, 255, 0.03);
}

[data-bs-theme="dark"] .form-control {
    background:
        rgba(255, 255, 255, 0.05);
}

[data-bs-theme="dark"] .role-hero::before {
    background:
        rgba(13, 110, 253, 0.12);
}

[data-bs-theme="dark"] .role-hero::after {
    background:
        rgba(255, 193, 7, 0.08);
}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 768px) {

    .role-hero {
        min-height: 260px;
    }

    .role-content {
        padding: 30px 20px;
    }

    .role-card-body {
        padding: 18px;
    }

    .volleyball {
        width: 60px;
        height: 60px;
    }

    .volleyball::before {
        width: 48px;
        height: 24px;

        border-width: 4px;
    }

    .volleyball::after {
        width: 40px;
        height: 20px;

        border-width: 4px;
    }

    .ball-one {
        top: 15px;
        right: 5%;
    }

    .ball-two {
        bottom: 15px;
        left: 5%;
    }

}

</style>


<div class="container py-3 py-lg-4">

    {{-- =====================================================
         HEADER
         ===================================================== --}}

    <section class="role-hero mb-4">

        {{-- Bola voli dekorasi --}}
        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>


        <div class="role-content">

            <div class="d-flex align-items-center justify-content-between gap-3">

                <div>

                    <span class="badge rounded-pill badge-volley px-4 py-2 mb-3">
                        🏐 AREA ADMIN
                    </span>

                    <div class="volley-line"></div>

                    <h1 class="display-5 fw-bold mb-3 role-title">

                        Manage
                        <span class="text-volley">
                            Role
                        </span>

                    </h1>

                    <p class="lead role-description mb-0">

                        Kelola role dan hak registrasi pengguna sistem.

                    </p>

                </div>


                <a href="{{ route('admin.dashboard') }}"
                   class="btn btn-sm btn-outline-secondary btn-back">

                    &larr; Kembali

                </a>

            </div>

        </div>

    </section>


    {{-- =====================================================
         CONTENT
         ===================================================== --}}

    <div class="row g-4">


        {{-- =================================================
             TAMBAH ROLE
             ================================================= --}}

        <div class="col-lg-4">

            <div class="role-card h-100">

                <div class="role-card-header">

                    <h2 class="h6 mb-0 fw-bold">
                        Tambah Role Baru
                    </h2>

                </div>


                <div class="role-card-body">

                    <form method="POST"
                          action="{{ route('admin.roles.store') }}">

                        @csrf


                        <div class="mb-3">

                            <label class="form-label"
                                   for="name">

                                Nama Role

                            </label>


                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="form-control {{ errors()->has('name') ? 'is-invalid' : '' }}"
                                   placeholder="mis. editor"
                                   autofocus>


                            @error('name')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <div class="form-check mb-3">

                            <input type="checkbox"
                                   id="can_register"
                                   name="can_register"
                                   value="1"
                                   class="form-check-input"
                                   {{ old('can_register') ? 'checked' : '' }}>


                            <label class="form-check-label"
                                   for="can_register">

                                Bisa registrasi sendiri
                                (muncul di halaman /register)

                            </label>

                        </div>


                        <p class="small text-secondary mb-3">

                            Middleware untuk role ini dibuat otomatis
                            dan langsung bisa dipakai lewat

                            <code class="inline">
                                -&gt;middleware('nama-role')
                            </code>.

                        </p>


                        {{-- SAMA DENGAN TOMBOL MASUK --}}

                        <button class="btn btn-volley w-100"
                                type="submit">

                            Tambah Role

                        </button>

                    </form>

                </div>

            </div>

        </div>


        {{-- =================================================
             DAFTAR ROLE
             ================================================= --}}

        <div class="col-lg-8">

            <div class="role-card">

                <div class="role-card-header">

                    <h2 class="h6 mb-0 fw-bold">
                        Daftar Role
                    </h2>

                </div>


                <div class="role-card-body">

                    <div class="table-responsive">

                        <table class="table table-sm align-middle mb-0 role-table">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Nama</th>

                                    <th>Registrasi</th>

                                    <th>Aksi</th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($roles as $role)

                                    <tr>

                                        <td>
                                            {{ $role->id }}
                                        </td>


                                        <td>

                                            <span class="role-name">
                                                {{ $role->name }}
                                            </span>

                                        </td>


                                        <td>

                                            @if ($role->can_register)

                                                <span class="badge badge-open">
                                                    Terbuka
                                                </span>

                                            @else

                                                <span class="badge badge-closed">
                                                    Tertutup
                                                </span>

                                            @endif

                                        </td>


                                        <td>

                                            @if ($role->name === 'admin')

                                                <span class="text-secondary small">
                                                    Role bawaan
                                                </span>

                                            @else

                                                <div class="d-flex flex-wrap align-items-center gap-2">


                                                    {{-- ==========================
                                                         UPDATE ROLE
                                                         ========================== --}}

                                                    <form method="POST"
                                                          action="{{ route('admin.roles.update', ['role' => $role->id]) }}"
                                                          class="d-flex flex-wrap align-items-center gap-1">

                                                        @csrf

                                                        @method('PUT')


                                                        <input type="text"
                                                               name="name"
                                                               value="{{ $role->name }}"
                                                               class="form-control form-control-sm"
                                                               style="width: 100px"
                                                               required>


                                                        <div class="form-check form-check-inline m-0"
                                                             title="Bisa registrasi sendiri">

                                                            <input type="checkbox"
                                                                   name="can_register"
                                                                   value="1"
                                                                   class="form-check-input"
                                                                   id="reg{{ $role->id }}"
                                                                   {{ $role->can_register ? 'checked' : '' }}>


                                                            <label class="form-check-label small"
                                                                   for="reg{{ $role->id }}">

                                                                Daftar

                                                            </label>

                                                        </div>


                                                        {{-- SAMA DENGAN TOMBOL BIRU --}}

                                                        <button type="submit"
                                                                class="btn btn-sm btn-volley">

                                                            Simpan

                                                        </button>

                                                    </form>


                                                    {{-- ==========================
                                                         DELETE ROLE
                                                         ========================== --}}

                                                    <form method="POST"
                                                          action="{{ route('admin.roles.destroy', ['role' => $role->id]) }}"
                                                          onsubmit="return confirm('Hapus role &quot;{{ $role->name }}&quot;?')">

                                                        @csrf

                                                        @method('DELETE')


                                                        {{-- SAMA DENGAN TOMBOL KUNING --}}

                                                        <button type="submit"
                                                                class="btn btn-sm btn-volley-yellow">

                                                            Hapus

                                                        </button>

                                                    </form>

                                                </div>

                                            @endif

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td colspan="4"
                                            class="text-secondary text-center py-4">

                                            Belum ada role.

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
