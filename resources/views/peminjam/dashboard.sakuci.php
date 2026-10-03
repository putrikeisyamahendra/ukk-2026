@extends('layouts.app')

@section('title', config('app.name') . ' -- Dashboard')

@section('content')

<style>
html:has(.pm-page), html:has(.pm-page) body { overflow: hidden; }
.pm-page { position: fixed; top: 0; right: 0; bottom: 0; left: 260px; z-index: 1; overflow-y: auto; scrollbar-width: none; background: var(--bs-body-bg); color: var(--bs-body-color); transition: left .3s ease; }
.pm-page::-webkit-scrollbar { display: none; }
:root:has(#sidebarToggle:checked) .pm-page { left: 0; }
.pm-content { width: 100%; max-width:@extends('layouts.app')

@section('title', config('app.name') . ' -- Dashboard')

@section('content')

<style>
html:has(.pm-page), html:has(.pm-page) body { overflow: hidden; }

.pm-page {
    position: fixed; top: 0; right: 0; bottom: 0; left: 260px;
    z-index: 1; overflow-x: hidden; overflow-y: auto; scrollbar-width: none;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    color: var(--bs-body-color);
    transition: left .3s ease;
}
.pm-page::-webkit-scrollbar { display: none; }
:root:has(#sidebarToggle:checked) .pm-page { left: 0; }

.pm-page::before { content: ""; position: fixed; width: 420px; height: 420px; background: rgba(13,110,253,.08); border-radius: 50%; top: -180px; left: -130px; pointer-events: none; }
.pm-page::after  { content: ""; position: fixed; width: 330px; height: 330px; background: rgba(255,193,7,.10); border-radius: 50%; bottom: -160px; right: -100px; pointer-events: none; }

.pm-content { position: relative; z-index: 2; width: 100%; max-width: 1000px; margin: 0 auto; padding: 80px 24px 40px; }

.badge-volley { background: linear-gradient(135deg, #0d6efd, #084298); color: #fff; font-weight: 600; box-shadow: 0 6px 18px rgba(13,110,253,.25); }
.volley-line { width: 65px; height: 4px; margin: 0 0 16px; border-radius: 10px; background: linear-gradient(90deg, #0d6efd, #ffc107); }
.pm-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.text-volley { background: linear-gradient(90deg, #0d6efd, #084298); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.pm-desc { color: var(--bs-secondary-color); }

.btn-volley { border: none; border-radius: 12px; font-weight: 700; color: #fff; background: linear-gradient(135deg, #0d6efd, #084298); box-shadow: 0 7px 18px rgba(13,110,253,.22); transition: all .3s ease; }
.btn-volley:hover { color: #fff; transform: translateY(-3px); box-shadow: 0 11px 25px rgba(13,110,253,.32); }
.btn-outline-volley { border-radius: 12px; font-weight: 700; color: #b38600; border: 1px solid #ffc107; background: transparent; transition: all .3s ease; }
.btn-outline-volley:hover { color: #102a43; background: linear-gradient(135deg, #ffc107, #ffda44); border-color: #ffc107; transform: translateY(-3px); }

.stat { display: flex; justify-content: space-between; align-items: center; padding: 1.4rem 1.6rem; height: 100%; border-radius: 24px; background: color-mix(in srgb, var(--bs-body-bg) 90%, transparent); border: 1px solid var(--bs-border-color); box-shadow: 0 12px 35px rgba(0,0,0,.08); backdrop-filter: blur(10px); }
.stat-label { font-size: .75rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; color: var(--bs-secondary-color); }
.stat-num { font-size: 2.2rem; font-weight: 800; line-height: 1.2; }
.stat-sub { color: var(--bs-secondary-color); font-size: .9rem; }
.stat-icon { width: 58px; height: 58px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }

.c-yellow { color: #b38600; } .i-yellow { background: rgba(255,193,7,.18); }
.c-blue   { color: #0d6efd; } .i-blue   { background: rgba(13,110,253,.12); }
.c-green  { color: #198754; } .i-green  { background: rgba(25,135,84,.15); }
.c-red    { color: #dc3545; } .i-red    { background: rgba(220,53,69,.15); }

.volleyball { position: fixed; width: 85px; height: 85px; border-radius: 50%; background: var(--bs-tertiary-bg); box-shadow: 0 12px 28px rgba(0,0,0,.15); z-index: 1; opacity: .9; pointer-events: none; bottom: 6%; right: 5%; animation: floating 4s ease-in-out infinite; }
.volleyball::before { content: ""; position: absolute; width: 68px; height: 34px; border-top: 5px solid #0d6efd; border-radius: 50%; top: 14px; left: 4px; transform: rotate(35deg); }
.volleyball::after  { content: ""; position: absolute; width: 56px; height: 28px; border-bottom: 5px solid #ffc107; border-radius: 50%; bottom: 14px; right: 4px; transform: rotate(-35deg); }
@keyframes floating { 0%,100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-15px) rotate(8deg); } }

@media (max-width: 991px) { .pm-page, :root:has(#sidebarToggle:checked) .pm-page { left: 0; } }
@media (max-width: 768px) { .pm-content { padding: 80px 15px 30px; } .volleyball { display: none; } }
</style>

<section class="pm-page">

    <div class="volleyball"></div>

    <div class="pm-content">

        <div class="mb-4">
            <span class="badge rounded-pill badge-volley px-4 py-2 mb-3">🏐 ROLE: PEMINJAM</span>
            <div class="volley-line"></div>
            <h1 class="display-5 fw-bold mb-2 pm-title">
                Halo, <span class="text-volley">{{ $user->username }}</span>!
            </h1>
            <p class="pm-desc mb-4">
                Selamat datang di Sistem Peminjaman Alat Olahraga Voli. Pantau status peminjaman dan tagihan dendamu di sini.
            </p>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('peminjam.ajukan') }}" class="btn btn-volley btn-lg px-4">+ Ajukan Peminjaman</a>
            </div>
        </div>

        <div class="row g-3">

            <div class="col-12 col-md-6">
                <div class="stat">
                    <div>
                        <div class="stat-label">Menunggu</div>
                        <div class="stat-num c-yellow">{{ $menunggu }}</div>
                        <div class="stat-sub">Persetujuan petugas</div>
                    </div>
                    <div class="stat-icon i-yellow">⏳</div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="stat">
                    <div>
                        <div class="stat-label">Dipinjam</div>
                        <div class="stat-num c-blue">{{ $dipinjam }}</div>
                        <div class="stat-sub">Alat yang kamu bawa</div>
                    </div>
                    <div class="stat-icon i-blue">📦</div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="stat">
                    <div>
                        <div class="stat-label">Selesai</div>
                        <div class="stat-num c-green">{{ $selesai }}</div>
                        <div class="stat-sub">Peminjaman selesai</div>
                    </div>
                    <div class="stat-icon i-green">✅</div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="stat">
                    <div>
                        <div class="stat-label">Total Denda</div>
                        <div class="stat-num c-red">Rp {{ number_format($denda, 0, ',', '.') }}</div>
                        <div class="stat-sub">Tagihan denda</div>
                    </div>
                    <div class="stat-icon i-red">⚠️</div>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection 1000px; margin: 0 auto; padding: 80px 24px 40px; }

.hero { position: relative; overflow: hidden; border-radius: 28px; padding: 2.2rem; color: #fff; background: linear-gradient(135deg, #0f7a4d, #055a3b); box-shadow: 0 14px 35px rgba(5, 90, 59, .3); }
.hero::after { content: ""; position: absolute; width: 380px; height: 380px; border: 1px solid rgba(255,255,255,.15); border-radius: 50%; top: -200px; right: -100px; }
.hero-badge { display: inline-block; padding: 6px 14px; border-radius: 50px; background: #d4f24a; color: #064e32; font-weight: 700; font-size: .8rem; margin-bottom: 1rem; }
.hero h1 { font-weight: 800; }
.hero p { color: rgba(255,255,255,.85); max-width: 640px; }
.hero-btn { display: inline-block; padding: .8rem 1.6rem; border-radius: 50px; background: #fff; color: #064e32; font-weight: 700; text-decoration: none; transition: transform .2s; }
.hero-btn:hover { transform: translateY(-3px); color: #064e32; }

.stat { display: flex; justify-content: space-between; align-items: center; padding: 1.4rem 1.6rem; border-radius: 22px; background: var(--bs-tertiary-bg); border: 1px solid var(--bs-border-color); height: 100%; }
.stat-label { font-size: .8rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; color: var(--bs-secondary-color); }
.stat-num { font-size: 2.2rem; font-weight: 800; line-height: 1.2; }
.stat-sub { color: var(--bs-secondary-color); }
.stat-icon { width: 58px; height: 58px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }

.c-warn  { color: #f5b301; } .i-warn  { background: rgba(245,179,1,.15); }
.c-green { color: #198754; } .i-green { background: rgba(25,135,84,.15); }
.c-red   { color: #dc3545; } .i-red   { background: rgba(220,53,69,.15); }

@media (max-width: 991px) { .pm-page, :root:has(#sidebarToggle:checked) .pm-page { left: 0; } }
@media (max-width: 768px) { .pm-content { padding: 80px 15px 30px; } }
</style>

<section class="pm-page">
    <div class="pm-content">

        <div class="hero mb-4">
            <span class="hero-badge">🛡️ ROLE: PEMINJAM</span>
            <h1 class="mb-2">Halo, {{ $user->username }}! 👋</h1>
            <p class="mb-4">Selamat datang di Sistem Peminjaman Alat. Silakan pantau status peminjaman dan tagihan denda Anda melalui ringkasan di bawah ini.</p>
            <a href="{{ route('peminjam.ajukan') }}" class="hero-btn">＋ Ajukan Peminjaman Baru</a>
        </div>

        <div class="row g-3">

            <div class="col-12 col-md-6">
                <div class="stat">
                    <div>
                        <div class="stat-label">Menunggu</div>
                        <div class="stat-num c-warn">{{ $menunggu }}</div>
                        <div class="stat-sub">Persetujuan petugas</div>
                    </div>
                    <div class="stat-icon i-warn">⏳</div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="stat">
                    <div>
                        <div class="stat-label">Dipinjam</div>
                        <div class="stat-num c-green">{{ $dipinjam }}</div>
                        <div class="stat-sub">Alat yang Anda bawa</div>
                    </div>
                    <div class="stat-icon i-green">📦</div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="stat">
                    <div>
                        <div class="stat-label">Selesai</div>
                        <div class="stat-num c-green">{{ $selesai }}</div>
                        <div class="stat-sub">Peminjaman selesai</div>
                    </div>
                    <div class="stat-icon i-green">✅</div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="stat">
                    <div>
                        <div class="stat-label">Total Denda</div>
                        <div class="stat-num c-red">Rp {{ number_format($denda, 0, ',', '.') }}</div>
                        <div class="stat-sub">Tagihan denda</div>
                    </div>
                    <div class="stat-icon i-red">⚠️</div>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection