@extends('layouts.app')

@section('title', 'Login')

@section('content')

<style>

/* =========================================================
   VOLLEYBALL LOGIN THEME
   ========================================================= */

.login-page {
    position: relative;
}


/* =========================================================
   LOGIN HERO
   ========================================================= */

.login-hero {
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


/* =========================================================
   BACKGROUND DECORATION
   ========================================================= */

.login-hero::before {
    content: "";

    position: absolute;

    width: 420px;
    height: 420px;

    background: rgba(13, 110, 253, 0.08);

    border-radius: 50%;

    top: -180px;
    left: -130px;
}

.login-hero::after {
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
   LOGIN CONTENT
   ========================================================= */

.login-content {
    position: relative;

    z-index: 2;

    width: 100%;
    max-width: 500px;

    padding: 40px 20px;
}


/* =========================================================
   LOGIN CARD
   ========================================================= */

.login-card {
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

.login-card-body {
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

.login-title {
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

.login-description {
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
   REGISTER LINK
   ========================================================= */

.login-link {
    color: #0d6efd;

    font-weight: 600;

    text-decoration: none;
}

.login-link:hover {
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

[data-bs-theme="dark"] .login-hero {
    background: linear-gradient(
        135deg,
        var(--bs-body-bg),
        #172033
    );
}

[data-bs-theme="dark"] .login-card {
    background:
        rgba(255, 255, 255, 0.05);

    box-shadow:
        0 12px 35px rgba(0, 0, 0, 0.30);
}

[data-bs-theme="dark"] .form-control {
    background:
        rgba(255, 255, 255, 0.05);
}

[data-bs-theme="dark"] .login-hero::before {
    background:
        rgba(13, 110, 253, 0.12);
}

[data-bs-theme="dark"] .login-hero::after {
    background:
        rgba(255, 193, 7, 0.08);
}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 768px) {

    .login-hero {
        min-height: 70vh;
    }

    .login-content {
        padding: 30px 15px;
    }

    .login-card-body {
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


<div class="container py-3 py-lg-4 login-page">

    <section class="login-hero">

        {{-- Bola voli dekorasi --}}
        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>


        <div class="login-content">

            <div class="login-card">

                <div class="login-card-body text-center">


                    {{-- =================================================
                         HEADER
                         ================================================= --}}

                    <span class="badge rounded-pill badge-volley px-4 py-2 mb-4">

                        🏐 PEMINJAMAN ALAT OLAHRAGA VOLI

                    </span>


                    <div class="volley-line"></div>


                    <h1 class="display-6 fw-bold mb-2 login-title">

                        Selamat
                        <span class="text-volley">
                            Datang!
                        </span>

                    </h1>


                    <p class="login-description mb-4">

                        Silakan masuk untuk melanjutkan
                        ke sistem peminjaman alat olahraga voli.

                    </p>


                    {{-- =================================================
                         FORM LOGIN
                         ================================================= --}}

                    <form method="POST"
                          action="{{ route('login.attempt') }}">

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


                        {{-- =================================================
                             AKUN DEMO
                             ================================================= --}}

                        <p class="text-secondary small mb-4">

                            Akun demo:
                            <strong>admin</strong>
                            &mdash;
                            password
                            <code class="inline">rahasia123</code>

                        </p>


                        {{-- =================================================
                             TOMBOL LOGIN — KUNING
                             ================================================= --}}

                        <button class="btn btn-volley-yellow w-100 py-2"
                                type="submit">

                            Login

                        </button>

                    </form>


                    {{-- =================================================
                         REGISTER
                         ================================================= --}}

                    @php

                        $canRegister = false;

                        try {

                            $canRegister =
                                \App\Models\Role::where(
                                    'can_register',
                                    1
                                )->exists();

                        } catch (\Throwable $e) {

                            $canRegister = false;

                        }

                    @endphp


                    @if ($canRegister)

                        <p class="text-secondary small text-center mt-4 mb-0">

                            Belum punya akun?

                            <a href="{{ route('register') }}"
                               class="login-link">

                                Daftar di sini

                            </a>.

                        </p>

                    @endif

                </div>

            </div>

        </div>

    </section>

</div>

@endsection
