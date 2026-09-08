@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Kategori</h1>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kode Kategori</th>
            <th>Nama Kategori</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($kategori as $item)
        <tr>
            <td>{{ $item->id_kategori }}</td>
            <td>{{ $item->kode_kategori }}</td>
            <td>{{ $item->nama_kategori }}</td>
            <td>{{ $item->keterangan }}</td>
            <td>
                <a href="" class="btn btn-success btn-sm">Edit</a>
                <a href="" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
{!! $kategori->links() !!}
@endsection