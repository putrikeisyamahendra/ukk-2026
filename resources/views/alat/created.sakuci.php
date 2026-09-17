@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Tambah Kategori</h1>
    <form action="{{ route('alat.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">

            <label for="nama_alat">Nama Alat</label>
            <input type="text" name="nama_alat" id="nama_alat" class="form-control" required>

            <label for="kode_alat">Kode Alat</label>
            <input type="text" name="kode_alat" id="kode_alat" class="form-control" required>

        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection