@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')
<h1>Tambahkan Alat</h1>
<form action="{{ route('alat.store') }}" method="POST" class="d-flex flex-column gap-2">
    @csrf

    <label>Nama alat</label>
    <input type="text" name="nama_alat" id="nama_alat" class="form-control" value="{{ old('nama_alat') }}" required>

    <label>Kode alat</label>
    <input type="text" name="kode_alat" id="kode_alat" class="form-control" value="{{ old('kode_alat') }}" required>

    <label>Kategori</label>
    <select name="id_kategori" id="id_kategori" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach ($kategori as $k)
            <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                {{ $k->nama_kategori }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection