@extends('layouts.app')

@section('title', 'Peminjaman Alat Voli')

@section('content')

<style>
html:has(.wl-page), html:has(.wl-page) body { overflow: hidden; }

.wl-page {
    position: fixed; top: 0; right: 0; bottom: 0; left: 260px; z-index: 1;
    overflow-x: hidden; overflow-y: auto; scrollbar-width: none;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    color: var(--bs-body-color);
    transition: left .3s ease;
}
.wl-page::-webkit-scrollbar { display: none; }
:root:has(#sidebarToggle:checked) .wl-page { left: 0; }

.wl-page::before {
    content: ""; position: fixed; width: 420px; height: 420px;
    background: rgba(13,110,253,.08); border-radius: 50%;
    top: -180px; left: -130px; pointer-events: none;
}
.wl-page::after {
    content: ""; position: fixed; width: 330px; height: 330px;
    background: rgba(255,193,7,.10); border-radius: 50%;
    bottom: -160px; right: -100px; pointer-events: none;
}

.wl-content { position: relative; z-index: 2; max-width: 1000px; margin: 0 auto; padding: 90px 24px 40px; }

.badge-volley { background: linear-gradient(135deg, #0d6efd, #084298); color: #fff; font-weight: 600; box-shadow: 0 6px 18px rgba(13,110,253,.25); }
.volley-line { width: 65px; height: 4px; margin: 0 auto 22px; border-radius: 10px; background: linear-gradient(90deg, #0d6efd, #ffc107); }
.wl-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.text-volley { background: linear-gradient(90deg, #0d6efd, #084298); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.wl-desc { color: var(--bs-secondary-color); line-height: 1.8; }

.btn-volley { border: none; border-radius: 12px; font-weight: 700; color: #fff; background: linear-gradient(135deg, #0d6efd, #084298); box-shadow: 0 7px 18px rgba(13,110,253,.22); transition: all .3s ease; }
.btn-volley:hover { color: #fff; transform: translateY(-3px); box-shadow: 0 11px 25px rgba(13,110,253,.32); }
.btn-volley-yellow { border: none; border-radius: 12px; font-weight: 700; color: #102a43; background: linear-gradient(135deg, #ffc107, #ffda44); box-shadow: 0 7px 18px rgba(255,193,7,.25); transition: all .3s ease; }
.btn-volley-yellow:hover { color: #102a43; transform: translateY(-3px); }

.wl-hero { text-align: center; padding: 20px 0 50px; }

.section-subtitle {
    font-size: 20px; font-weight: 700; color: var(--bs-heading-color);
    margin: 0 0 18px; display: flex; align-items: center; gap: 8px;
}
.section-subtitle::before { content: ""; width: 4px; height: 20px; background: #0d6efd; border-radius: 4px; }
.wl-section { margin-top: 40px; }

.wl-card {
    height: 100%; padding: 24px; border-radius: 20px; text-align: center;
    background: var(--bs-body-bg); border: 1px solid var(--bs-border-color);
    box-shadow: 0 8px 24px rgba(0,0,0,.06); transition: all .3s ease;
}
.wl-card:hover { transform: translateY(-5px); border-color: #0d6efd; box-shadow: 0 14px 30px rgba(13,110,253,.15); }
.wl-icon {
    width: 52px; height: 52px; margin: 0 auto 14px; border-radius: 15px;
    display: flex; align-items: center; justify-content: center; font-size: 22px; color: #fff;
    background: linear-gradient(135deg, #0d6efd, #084298); box-shadow: 0 6px 15px rgba(13,110,253,.20);
}
.wl-card h3 { color: var(--bs-heading-color); }
.wl-card p { color: var(--bs-secondary-color); margin: 0; }

.wl-step {
    display: flex; gap: 14px; align-items: flex-start; height: 100%; padding: 18px 20px;
    border-radius: 16px; background: var(--bs-body-bg); border: 1px solid var(--bs-border-color);
    box-shadow: 0 6px 18px rgba(0,0,0,.05);
}
.wl-num {
    flex-shrink: 0; width: 38px; height: 38px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center; font-weight: 800;
    background: linear-gradient(135deg, #ffc107, #ffda44); color: #102a43;
}
.wl-step strong { color: var(--bs-heading-color); display: block; }
.wl-step span { color: var(--bs-secondary-color); font-size: .9rem; }

.wl-info {
    padding: 22px 26px; border-radius: 18px;
    background: rgba(255,193,7,.10); border: 1px solid rgba(255,193,7,.30);
}
.wl-info strong { color: var(--bs-heading-color); }
.wl-info ul { margin: 10px 0 0; padding-left: 20px; color: var(--bs-secondary-color); }

.wl-cta {
    text-align: center; padding: 34px 24px; border-radius: 22px;
    background: linear-gradient(135deg, rgba(13,110,253,.10), rgba(255,193,7,.10));
    border: 1px solid var(--bs-border-color); box-shadow: 0 12px 35px rgba(0,0,0,.08);
}

.wl-footer { margin-top: 40px; text-align: center; color: var(--bs-secondary-color); font-size: .85rem; }

.volleyball {
    position: fixed; width: 85px; height: 85px; border-radius: 50%;
    background: var(--bs-tertiary-bg); box-shadow: 0 12px 28px rgba(0,0,0,.15);
    z-index: 1; opacity: .9; pointer-events: none; top: 110px; right: 6%;
    animation: floating 4s ease-in-out infinite;
}
.volleyball::before {
    content: ""; position: absolute; width: 68px; height: 34px;
    border-top: 5px solid #0d6efd; border-radius: 50%; top: 14px; left: 4px; transform: rotate(35deg);
}
.volleyball::after {
    content: ""; position: absolute; width: 56px; height: 28px;
    border-bottom: 5px solid #ffc107; border-radius: 50%; bottom: 14px; right: 4px; transform: rotate(-35deg);
}
@keyframes floating { 0%,100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-15px) rotate(8deg); } }

@media (max-width: 991px) { .wl-page, :root:has(#sidebarToggle:checked) .wl-page { left: 0; } }
@media (max-width: 768px) { .wl-content { padding: 80px 15px 30px; } .volleyball { display: none; } }
</style>

<section class="wl-page">

    <div class="volleyball"></div>

    <div class="wl-content">

        {{-- HERO --}}
        <div class="wl-hero">
            <span class="badge rounded-pill badge-volley px-4 py-2 mb-4">🏐 PEMINJAMAN ALAT OLAHRAGA VOLI</span>
            <div class="volley-line"></div>
            <h1 class="display-4 fw-bold mb-3 wl-title">
                Selamat Datang di<br>
                <span class="text-volley">Sistem Peminjaman Buatan Keisha!</span>
            </h1>
            <p class="lead wl-desc mx-auto mb-4" style="max-width: 640px;">
                Aplikasi untuk membantu proses peminjaman dan pengembalian alat olahraga voli.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="{{ route('login') }}" class="btn btn-volley btn-lg px-4">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-volley-yellow btn-lg px-4">Daftar</a>
            </div>
        </div>

        {{-- FITUR --}}
        <div class="wl-section">
            <h2 class="section-subtitle">Kenapa pakai sistem ini?</h2>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="wl-card">
                        <div class="wl-icon">🏷️</div>
                        <h3 class="h6 fw-bold mb-2">Katalog Alat</h3>
                        <p class="small">Lihat alat voli yang tersedia beserta stoknya sebelum meminjam.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="wl-card">
                        <div class="wl-icon">📝</div>
                        <h3 class="h6 fw-bold mb-2">Ajukan Online</h3>
                        <p class="small">Ajukan peminjaman kapan saja tanpa harus mencatat di buku.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="wl-card">
                        <div class="wl-icon">📊</div>
                        <h3 class="h6 fw-bold mb-2">Pantau Status</h3>
                        <p class="small">Cek status pengajuan, batas kembali, dan denda dengan mudah.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARA MEMINJAM --}}
        <div class="wl-section">
            <h2 class="section-subtitle">Cara Meminjam</h2>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="wl-step">
                        <div class="wl-num">1</div>
                        <div><strong>Daftar &amp; masuk</strong><span>Buat akun peminjam, lalu login.</span></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wl-step">
                        <div class="wl-num">2</div>
                        <div><strong>Pilih alat</strong><span>Buka katalog dan pilih alat yang ingin dipinjam.</span></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wl-step">
                        <div class="wl-num">3</div>
                        <div><strong>Tunggu persetujuan</strong><span>Petugas akan menyetujui atau menolak pengajuanmu.</span></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wl-step">
                        <div class="wl-num">4</div>
                        <div><strong>Kembalikan tepat waktu</strong><span>Kembalikan alat sebelum batas agar tidak kena denda.</span></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ATURAN --}}
        <div class="wl-section">
            <div class="wl-info">
                <strong>⚠️ Aturan Peminjaman</strong>
                <ul>
                    <li>Isi rencana tanggal kembali saat mengajukan peminjaman.</li>
                    <li>Keterlambatan dikenai denda <strong>Rp5.000 per hari</strong>.</li>
                    <li>Jaga alat tetap dalam kondisi baik. Alat rusak atau hilang dicatat petugas.</li>
                </ul>
            </div>
        </div>


        <div class="wl-footer">
            🏐 Keisha Putri &copy; {{ date('Y') }}
        </div>

    </div>

</section>

@endsection