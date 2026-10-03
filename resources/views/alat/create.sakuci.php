@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambahkan Alat')

@section('content')

<style>
.alat-wrapper { position: relative; overflow: hidden; border-radius: 24px; padding: 45px 30px; background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg)); color: var(--bs-body-color); }
.alat-content { position: relative; z-index: 2; max-width: 850px; margin: 0 auto; }
.alat-header { text-align: center; margin-bottom: 30px; }
.alat-badge { display: inline-block; background: linear-gradient(135deg, #0d6efd, #084298); color: #fff; font-weight: 600; padding: 9px 22px; border-radius: 50px; }
.alat-title { color: var(--bs-heading-color); font-weight: 700; margin: 18px 0 10px; }
.alat-title span { background: linear-gradient(90deg, #0d6efd, #084298); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.alat-line { width: 65px; height: 4px; margin: 0 auto; border-radius: 10px; background: linear-gradient(90deg, #0d6efd, #ffc107); }
.alat-form { background: color-mix(in srgb, var(--bs-body-bg) 92%, transparent); border: 1px solid var(--bs-border-color); border-radius: 20px; padding: 35px; }
.alat-form label { display: block; font-weight: 600; margin-bottom: 8px; }
.btn-volley { border: none; border-radius: 11px; font-weight: 700; color: #fff; background: linear-gradient(135deg, #0d6efd, #084298); }
.btn-volley:hover { color: #fff; }
.btn-volley-yellow { border: none; border-radius: 11px; font-weight: 700; color: #102a43; background: linear-gradient(135deg, #ffc107, #ffda44); }
</style>

<div class="container py-3 py-lg-4">
    <section class="alat-wrapper">
        <div class="alat-content">

            <div class="alat-header">
                <span class="alat-badge">🏐 ALAT OLAHRAGA VOLI</span>
                <h1 class="display-6 alat-title">Tambahkan <span>Alat</span></h1>
                <div class="alat-line"></div>
            </div>

            <form action="{{ route('alat.store') }}" method="POST" class="alat-form">
                @csrf

                <div class="mb-4">
                    <label for="nama_alat">Nama Alat</label>
                    <input type="text" name="nama_alat" id="nama_alat" class="form-control" value="{{ old('nama_alat') }}" required>
                </div>

                <div class="mb-4">
                    <label for="kode_alat">Kode Alat</label>
                    <input type="text" name="kode_alat" id="kode_alat" class="form-control" value="{{ old('kode_alat') }}" required>
                </div>

                <div class="mb-4">
                    <label for="id_kategori">Kategori</label>
                    <select name="id_kategori" id="id_kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok', 0) }}" min="0" required>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-volley px-4 py-2">💾 Simpan</button>
                    <a href="{{ route('alat.index') }}" class="btn btn-volley-yellow px-4 py-2">↩ Kembali</a>
                </div>
            </form>

        </div>
    </section>
</div>

@endsection