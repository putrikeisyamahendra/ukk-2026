@extends('layouts.app')

@section('title', 'Daftar')

@section('content')

<style>

/* =========================================================
   VOLLEYBALL REGISTER THEME
   ========================================================= */

.register-hero {
    position: relative;

    min-height: 75vh;

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


/* =========================================================
   BACKGROUND DECORATION
   ========================================================= */

.register-hero::before {
    content: "";

    position: absolute;

    width: 420px;
    height: 420px;

    background: rgba(13, 110, 253, 0.08);

    border-radius: 50%;

    top: -180px;
    left: -130px;
}

.register-hero::after {
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
   CONTENT
   ========================================================= */

.register-content {
    position: relative;

    z-index: 2;

    width: 100%;
    max-width: 540px;

    padding: 40px 20px;
}


/* =========================================================
   CARD
   ========================================================= */

.register-card {
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

.register-card-body {
    padding: 35px;
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

.register-title {
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

.register-description {
    color: var(--bs-secondary-color);

    line-height: 1.8;
}


/* =========================================================
   LINE
   ========================================================= */

.volley-line {
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
   FORM
   ========================================================= */

.form-control,
.form-select {
    border-radius: 10px;

    background: color-mix(
        in srgb,
        var(--bs-body-bg) 75%,
        transparent
    );
}

.form-control:focus,
.form-select:focus {
    border-color: #0d6efd;

    box-shadow:
        0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}


/* =========================================================
   BUTTON LOGIN — BIRU
   ========================================================= */

.btn-volley-yellow {
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

.btn-volley-yellow:hover {
    color: #fff;

    transform: translateY(-3px);

    background: linear-gradient(
        135deg,
        #0b5ed7,
        #06357a
    );

    box-shadow:
        0 11px 25px rgba(13, 110, 253, 0.32);
}


.btn-volley-yellow:hover {
    color: #102a43;

    transform: translateY(-3px);

    box-shadow:
        0 11px 25px rgba(255, 193, 7, 0.32);
}


/* =========================================================
   LOGIN LINK
   ========================================================= */

.register-link {
    color: #0d6efd;

    font-weight: 600;

    text-decoration: none;
}

.register-link:hover {
    color: #084298;

    text-decoration: underline;
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

    width: 85px;
    height: 42px;

    border-top:
        6px solid #0d6efd;

    border-radius: 50%;

    top: 17px;
    left: 5px;

    transform:
        rotate(35deg);
}

.volleyball::after {
    content: "";

    position: absolute;

    width: 70px;
    height: 35px;

    border-bottom:
        6px solid #ffc107;

    border-radius: 50%;

    bottom: 17px;
    right: 5px;

    transform:
        rotate(-35deg);
}

.ball-one {
    top: 12%;
    left: 7%;

    animation:
        floating 4s ease-in-out infinite;
}

.ball-two {
    bottom: 10%;
    right: 7%;

    width: 75px;
    height: 75px;

    animation:
        floating 5s ease-in-out infinite reverse;
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

[data-bs-theme="dark"] .register-hero {
    background: linear-gradient(
        135deg,
        var(--bs-body-bg),
        #172033
    );
}

[data-bs-theme="dark"] .register-card {
    background:
        rgba(255, 255, 255, 0.05);

    box-shadow:
        0 12px 35px rgba(0, 0, 0, 0.30);
}

[data-bs-theme="dark"] .form-control,
[data-bs-theme="dark"] .form-select {
    background:
        rgba(255, 255, 255, 0.05);
}

[data-bs-theme="dark"] .register-hero::before {
    background:
        rgba(13, 110, 253, 0.12);
}

[data-bs-theme="dark"] .register-hero::after {
    background:
        rgba(255, 193, 7, 0.08);
}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 768px) {

    .register-hero {
        min-height: 70vh;
    }

    .register-content {
        padding: 30px 15px;
    }

    .register-card-body {
        padding: 25px 20px;
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
}

</style>


<div class="container py-3 py-lg-4">

    <section class="register-hero">

        {{-- Bola voli dekorasi --}}
        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>


        <div class="register-content">

            <div class="register-card">

                <div class="register-card-body text-center">


                    {{-- =================================================
                         HEADER
                         ================================================= --}}

                    <span class="badge rounded-pill badge-volley px-4 py-2 mb-4">

                        🏐 PEMINJAMAN ALAT OLAHRAGA VOLI

                    </span>


                    <div class="volley-line"></div>


                    <h1 class="display-6 fw-bold mb-2 register-title">

                        Daftar
                        <span class="text-volley">
                            Akun
                        </span>

                    </h1>


                    <p class="register-description mb-4">

                        Buat akun baru untuk menggunakan
                        sistem peminjaman alat olahraga voli.

                    </p>


                    {{-- =================================================
                         FORM REGISTER
                         ================================================= --}}

                    <form method="POST"
                          action="{{ route('register.attempt') }}">

                        @csrf


                        {{-- USERNAME --}}

                        <div class="mb-3 text-start">

                            <label class="form-label"
                                   for="username">

                                Username

                            </label>


                            <input type="text"
                                   id="username"
                                   name="username"
                                   value="{{ old('username') }}"
                                   class="form-control {{ errors()->has('username') ? 'is-invalid' : '' }}"
                                   placeholder="Masukkan username"
                                   autofocus>


                            @error('username')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- PASSWORD --}}

                        <div class="mb-3 text-start">

                            <label class="form-label"
                                   for="password">

                                Password

                            </label>


                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control {{ errors()->has('password') ? 'is-invalid' : '' }}"
                                   placeholder="Masukkan password">


                            @error('password')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- KONFIRMASI PASSWORD --}}

                        <div class="mb-3 text-start">

                            <label class="form-label"
                                   for="password_confirmation">

                                Konfirmasi Password

                            </label>


                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password">

                        </div>


                        {{-- =================================================
                             ROLE
                             ================================================= --}}

                        @if (count($roles) > 1)

                            <div class="mb-3 text-start">

                                <label class="form-label"
                                       for="role">

                                    Daftar sebagai

                                </label>


                                <select id="role"
                                        name="role"
                                        class="form-select {{ errors()->has('role') ? 'is-invalid' : '' }}">

                                    @foreach ($roles as $role)

                                        <option value="{{ $role->name }}"
                                            {{ old('role') === $role->name ? 'selected' : '' }}>

                                            {{ $role->name }}

                                        </option>

                                    @endforeach

                                </select>


                                @error('role')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        @else

                            <input type="hidden"
                                   name="role"
                                   value="{{ $roles[0]->name }}">

                        @endif


                        {{-- =================================================
                             TOMBOL DAFTAR — KUNING
                             ================================================= --}}

                        <button class="btn btn-volley-yellow w-100 py-2"
                                type="submit">

                            Daftar

                        </button>

                    </form>


                    {{-- =================================================
                         LOGIN LINK
                         ================================================= --}}

                    <p class="text-secondary small text-center mt-4 mb-0">

                        Sudah punya akun?

                        <a href="{{ route('login') }}"
                           class="register-link">

                            Masuk di sini

                        </a>.

                    </p>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection
