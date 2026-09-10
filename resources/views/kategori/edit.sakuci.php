@extends('layouts.app')
@section('content')
    <h1>Edit Kategori</h1>
    <form action="{{ route('kategori.update', ['id_kategori' => $kategori->id_kategori]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $kategori->keterangan }}" required>

            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="{{ $kategori->nama_kategori }}" required>

            <label for="kode_kategori">Kode Kategori</label>
            <input type="text" name="kode_kategori" id="kode_kategori" class="form-control" value="{{ $kategori->kode_kategori }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>


@endsection