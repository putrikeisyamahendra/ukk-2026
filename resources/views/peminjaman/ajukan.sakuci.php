@extends('layouts.app')

@section('title', config('app.name') . ' -- Ajukan Peminjaman')

@section('content')

<style>
.alat-page { position: relative; overflow: hidden; }

.alat-header {
    position: relative; min-height: 240px; display: flex; align-items: center;
    overflow: hidden; padding: 2rem; border-radius: 24px;
    background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg));
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 12px 35px rgba(0,0,0,.08);
    margin-bottom: 1.5rem;
}
.alat-header::before {
    content: ""; position: absolute; width: 420px; height: 420px;
    background: rgba(13,110,253,.08); border-radius: 50%; top: -220px; right: -120px;
}
.alat-header::after {
    content: ""; position: absolute; width: 330px; height: 330px;
    background: rgba(255,193,7,.10); border-radius: 50%; bottom: -190px; left: -100px;
}
.alat-header-content { position: relative; z-index: 2; width: 100%; }

.badge-volley {
    display: inline-block; background: linear-gradient(135deg, #0d6efd, #084298);
    color: #fff; font-weight: 700; box-shadow: 0 6px 18px rgba(13,110,253,.25);
}
.alat-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.text-volley {
    background: linear-gradient(90deg, #0d6efd, #084298);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.alat-description { color: var(--bs-secondary-color); line-height: 1.8; }
.volley-line {
    width: 65px; height: 4px; margin-bottom: 20px; border-radius: 10px;
    background: linear-gradient(90deg, #0d6efd, #ffc107);
}

.alat-card {
    overflow: hidden; border-radius: 24px; background: var(--bs-body-bg);
    border: 1px solid var(--bs-border-color); box-shadow: 0 12px 35px rgba(0,0,0,.07);
}
.alat-card-header {
    padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--bs-border-color);
    background: linear-gradient(135deg, rgba(13,110,253,.05), rgba(255,193,7,.04));
}
.alat-card-title { color: var(--bs-heading-color); font-weight: 700; }
.alat-card-subtitle { color: var(--bs-secondary-color); font-size: .85rem; }
.alat-card-body { padding: 1.75rem 1.5rem; }
.alat-card-body label { font-weight: 600; margin-bottom: 8px; }
.alat-card-body .form-control,
.alat-card-body .form-select { border-radius: 11px; padding: 12px 15px; }
.alat-card-body .form-control:focus,
.alat-card-body .form-select:focus {
    border-color: #0d6efd; box-shadow: 0 0 0 .2rem rgba(13,110,253,.12);
}

.btn-volley {
    border: none; border-radius: 12px; font-weight: 700; color: #fff;
    background: linear-gradient(135deg, #0d6efd, #084298);
    box-shadow: 0 7px 18px rgba(13,110,253,.22); transition: all .3s ease;
}
.btn-volley:hover { color: #fff; transform: translateY(-3px); box-shadow: 0 11px 25px rgba(13,110,253,.32); }

.btn-volley-yellow {
    border: none; border-radius: 12px; font-weight: 700; color: #102a43;
    background: linear-gradient(135deg, #ffc107, #ffda44);
    box-shadow: 0 7px 18px rgba(255,193,7,.25); transition: all .3s ease;
}
.btn-volley-yellow:hover { color: #102a43; transform: translateY(-3px); }

.volleyball {
    position: absolute; width: 105px; height: 105px; border-radius: 50%;
    background: var(--bs-tertiary-bg); border: none;
    box-shadow: 0 12px 28px rgba(0,0,0,.15); z-index: 1; opacity: .95;
}
.volleyball::before {
    content: ""; position: absolute; width: 85px; height: 42px;
    border-top: 6px solid #0d6efd; border-radius: 50%; top: 17px; left: 5px; transform: rotate(35deg);
}
.volleyball::after {
    content: ""; position: absolute; width: 70px; height: 35px;
    border-bottom: 6px solid #ffc107; border-radius: 50%; bottom: 17px; right: 5px; transform: rotate(-35deg);
}
.ball-one { top: 15%; right: 7%; animation: floating 4s ease-in-out infinite; }
.ball-two {
    bottom: 8%; right: 2%; width: 75px; height: 75px; opacity: .65;
    animation: floating 5s ease-in-out infinite reverse;
}
.ball-two::before { width: 60px; height: 30px; border-width: 4px; }
.ball-two::after { width: 50px; height: 25px; border-width: 4px; }

@keyframes floating {
    0%,100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(8deg); }
}

:root:has(#themeToggle:checked) .alat-header { background: linear-gradient(135deg, var(--bs-body-bg), #172033); }
:root:has(#themeToggle:checked) .alat-header::before { background: rgba(13,110,253,.12); }
:root:has(#themeToggle:checked) .alat-header::after { background: rgba(255,193,7,.08); }

@media (max-width: 768px) {
    .alat-header { min-height: 280px; padding: 1.5rem; }
    .volleyball { width: 65px; height: 65px; }
    .volleyball::before { width: 52px; height: 25px; border-width: 4px; }
    .volleyball::after { width: 45px; height: 20px; border-width: 4px; }
    .ball-one { top: 7%; right: 4%; }
    .ball-two { display: none; }
}
</style>

<div class="container py-3 py-lg-4 alat-page">

    {{-- HEADER --}}
    <section class="alat-header">

        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>

        <div class="alat-header-content">

            <span class="badge rounded-pill badge-volley px-4 py-2 mb-4">🏐 PENGAJUAN</span>

            <div class="volley-line"></div>

            <h1 class="display-6 fw-bold mb-3 alat-title">
                Ajukan <span class="text-volley">Peminjaman</span>
            </h1>

            <p class="lead alat-description mb-0" style="max-width: 650px;">
                Pilih alat, tentukan jumlah dan tanggal kembali.
                Pengajuanmu akan diperiksa oleh petugas.
            </p>

        </div>

    </section>

    {{-- ALERT --}}
    @if (session('error'))
        <div class="alert alert-danger" style="border-radius: 14px;">⚠️ {{ session('error') }}</div>
    @endif

    {{-- FORM --}}
    <div class="alat-card">

        <div class="alat-card-header">
            <div class="alat-card-title">📝 Form Pengajuan</div>
            <div class="alat-card-subtitle">Semua kolom wajib diisi.</div>
        </div>

        <div class="alat-card-body">
            <form method="POST" action="{{ route('peminjam.kirim') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="id_alat">Pilih Alat</label>
                    <select id="id_alat" name="id_alat" class="form-select" required>
                        <option value="">-- Pilih Alat --</option>
                        @foreach ($alat as $item)
    <option value="{{ $item->id_alat }}"
        {{ (int) request('alat') === (int) $item->id_alat ? 'selected' : '' }}>
        {{ $item->nama_alat }} (stok: {{ (int) $item->stok }})
    </option>
@endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="jumlah">Jumlah Unit</label>
                    <input type="number" id="jumlah" name="jumlah" class="form-control" min="1" value="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="tanggal_pinjam">Tanggal Pinjam</label>
                    <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="tanggal_kembali">Rencana Tanggal Kembali</label>
                    <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control" required>
                </div>

               <div class="d-flex flex-wrap gap-2">
    <button type="submit" class="btn btn-volley btn-lg flex-fill">Ajukan Peminjaman</button>
    <a href="{{ route('dashboard') }}" class="btn btn-volley-yellow btn-lg px-4">↩ Kembali</a>
</div>
            </form>
        </div>

    </div>

</div>

@endsection