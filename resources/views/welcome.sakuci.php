@extends('layouts.app')

@section('title', 'Peminjaman Alat Voli')

@section('content')

<style>
/* Hilangkan scrollbar browser di belakang hero */
html:has(.volley-hero),
html:has(.volley-hero) body {
    overflow: hidden;
}

/* Full screen, ikut bergeser saat sidebar dibuka/ditutup */
.volley-hero {
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

.volley-hero::-webkit-scrollbar {
    display: none;
}

/* Sidebar ditutup (desktop): hero melebar penuh */
:root:has(#sidebarToggle:checked) .volley-hero {
    left: 0;
}

.volley-content {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 40px 20px;
}

.volley-hero::before {
    content: "";
    position: absolute;
    width: 420px;
    height: 420px;
    background: rgba(13, 110, 253, 0.08);
    border-radius: 50%;
    top: -180px;
    left: -130px;
}

.volley-hero::after {
    content: "";
    position: absolute;
    width: 330px;
    height: 330px;
    background: rgba(255, 193, 7, 0.10);
    border-radius: 50%;
    bottom: -160px;
    right: -100px;
}

.badge-volley {
    background: linear-gradient(135deg, #0d6efd, #084298);
    color: #fff;
    font-weight: 600;
    box-shadow: 0 6px 18px rgba(13, 110, 253, 0.25);
}

.volley-title {
    color: var(--bs-heading-color);
    letter-spacing: -1px;
}

.text-volley {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.volley-description {
    color: var(--bs-secondary-color);
    line-height: 1.8;
}

.volley-line {
    width: 65px;
    height: 4px;
    margin: 0 auto 22px;
    border-radius: 10px;
    background: linear-gradient(90deg, #0d6efd, #ffc107);
}

.volley-menu {
    margin: 30px auto 0;
    max-width: 500px;
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

.btn-volley-yellow {
    border: none;
    border-radius: 12px;
    font-weight: 700;
    color: #102a43;
    background: linear-gradient(135deg, #ffc107, #ffda44);
    box-shadow: 0 7px 18px rgba(255, 193, 7, 0.22);
    transition: all 0.3s ease;
}

.btn-volley-yellow:hover {
    color: #102a43;
    transform: translateY(-3px);
    box-shadow: 0 11px 25px rgba(255, 193, 7, 0.32);
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
    .volley-hero,
    :root:has(#sidebarToggle:checked) .volley-hero {
        left: 0;
    }
}

@media (max-width: 768px) {
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


<section class="volley-hero">

    <div class="volleyball ball-one"></div>
    <div class="volleyball ball-two"></div>

    <div class="volley-content">

        <span class="badge rounded-pill badge-volley px-4 py-2 mb-4">
            🏐 PEMINJAMAN ALAT OLAHRAGA VOLI
        </span>

        <div class="volley-line"></div>

        <h1 class="display-5 fw-bold mb-3 volley-title">
            Selamat Datang di<br class="d-none d-md-inline">
            <span class="text-volley">
                Sistem Peminjaman Buatan Keisha!
            </span>
        </h1>

        <p class="lead volley-description mx-auto mb-4" style="max-width: 620px;">
            Aplikasi untuk membantu proses peminjaman dan pengembalian alat olahraga voli.
        </p>

        <div class="volley-menu">
            <div class="d-flex flex-wrap gap-2 justify-content-center">

                <a class="btn btn-volley btn-lg px-4" href="{{ route('login') }}">
                    Masuk
                </a>

                <a class="btn btn-volley-yellow btn-lg px-4" href="{{ route('register') }}">
                    Daftar
                </a>

            </div>
        </div>

    </div>

</section>

@endsection