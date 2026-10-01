@extends('layouts.app')

@section('title', 'Daftar')

@section('content')

<style>
/* Hilangkan scrollbar browser di belakang hero */
html:has(.register-hero),
html:has(.register-hero) body {
    overflow: hidden;
}

/* Full screen, ikut bergeser saat sidebar dibuka/ditutup */
.register-hero {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 260px;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow-x: hidden;
    overflow-y: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
    border-radius: 0;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    color: var(--bs-body-color);
    transition: left .3s ease;
}

.register-hero::-webkit-scrollbar {
    display: none;
}

:root:has(#sidebarToggle:checked) .register-hero {
    left: 0;
}

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

/* Wrapper */
.register-content {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 380px;
    padding: 30px 15px;
    margin: auto;
}

/* Card persegi panjang ke bawah (ringkas) */
.register-card {
    padding: 28px 28px;
    border-radius: 20px;
    text-align: center;
    background: color-mix(in srgb, var(--bs-body-bg) 88%, transparent);
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.badge-volley {
    background: linear-gradient(135deg, #0d6efd, #084298);
    color: #fff;
    font-weight: 600;
    font-size: 11px;
    box-shadow: 0 6px 18px rgba(13, 110, 253, 0.25);
}

.register-title {
    color: var(--bs-heading-color);
    letter-spacing: -1px;
}

.text-volley {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.register-description {
    color: var(--bs-secondary-color);
    line-height: 1.7;
    font-size: 14px;
}

.volley-line {
    width: 65px;
    height: 4px;
    margin: 0 auto 18px;
    border-radius: 10px;
    background: linear-gradient(90deg, #0d6efd, #ffc107);
}

/* Form */
.register-card .form-label {
    color: var(--bs-heading-color);
}

.form-control,
.form-select {
    border-radius: 10px;
    background-color: var(--bs-body-bg);
    color: var(--bs-body-color);
    border: 1px solid var(--bs-border-color);
}

.form-control:focus,
.form-select:focus {
    background-color: var(--bs-body-bg);
    color: var(--bs-body-color);
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

.form-control::placeholder {
    color: var(--bs-secondary-color);
}

/* Tombol daftar (biru) */
.btn-volley-yellow {
    border: none;
    border-radius: 12px;
    font-weight: 700;
    color: #fff;
    background: linear-gradient(135deg, #0d6efd, #084298);
    box-shadow: 0 7px 18px rgba(13, 110, 253, 0.22);
    transition: all 0.3s ease;
}

.btn-volley-yellow:hover {
    color: #fff;
    transform: translateY(-3px);
    background: linear-gradient(135deg, #0b5ed7, #06357a);
    box-shadow: 0 11px 25px rgba(13, 110, 253, 0.32);
}

.register-link {
    color: #0d6efd;
    font-weight: 600;
    text-decoration: none;
}

.register-link:hover {
    color: #084298;
    text-decoration: underline;
}

/* Bola voli (tanpa border putih) */
.volleyball {
    position: absolute;
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

@keyframes floating {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(8deg); }
}

@media (max-width: 991px) {
    .register-hero,
    :root:has(#sidebarToggle:checked) .register-hero {
        left: 0;
    }
}

@media (max-width: 768px) {
    .register-card {
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


<section class="register-hero">

    {{-- Bola voli dekorasi --}}
    <div class="volleyball ball-one"></div>
    <div class="volleyball ball-two"></div>

    <div class="register-content">

        <div class="register-card">

            <span class="badge rounded-pill badge-volley px-3 py-2 mb-3">
                🏐 PEMINJAMAN ALAT OLAHRAGA VOLI
            </span>

            <div class="volley-line"></div>

            <h1 class="h2 fw-bold mb-2 register-title">
                Daftar
                <span class="text-volley">Akun</span>
            </h1>

            <p class="register-description mb-4">
                Buat akun baru untuk menggunakan
                sistem peminjaman alat olahraga voli.
            </p>


            {{-- FORM REGISTER --}}

            <form method="POST" action="{{ route('register.attempt') }}">

                @csrf

                {{-- USERNAME --}}

                <div class="mb-3 text-start">

                    <label class="form-label" for="username">
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

                    <label class="form-label" for="password">
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

                    <label class="form-label" for="password_confirmation">
                        Konfirmasi Password
                    </label>

                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Ulangi password">

                </div>


                {{-- ROLE --}}

                @if (count($roles) > 1)

                    <div class="mb-3 text-start">

                        <label class="form-label" for="role">
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


                {{-- TOMBOL DAFTAR --}}

                <button class="btn btn-volley-yellow w-100 py-2" type="submit">
                    Daftar
                </button>

            </form>


            {{-- LOGIN LINK --}}

            <p class="text-secondary small text-center mt-3 mb-0">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="register-link">Masuk di sini</a>.
            </p>

        </div>

    </div>

</section>

@endsection