@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Pengembalian')

@section('content')

<div class="container-fluid py-4 px-4">
{{-- Header --}}
<div class="mb-4">
    <div class="d-flex align-items-center gap-2 mb-2">
        <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-2 rounded-pill fw-semibold">
            <i class="bi bi-pencil-square me-1"></i>
            Edit Pengembalian
        </span>
    </div>

    <h3 class="fw-bold mb-1 text-body">
        Edit Data Pengembalian
    </h3>

    <p class="text-body-secondary small mb-0">
        Perbarui informasi pengembalian alat, keterlambatan, denda, dan kondisi barang.
    </p>
</div>


{{-- Card Form --}}
<div class="card border-0 bg-body-tertiary shadow-sm rounded-4 overflow-hidden">

    {{-- Card Header --}}
    <div class="card-header bg-transparent border-bottom py-3 px-4">

        <div class="d-flex align-items-center gap-2">

            <i class="bi bi-arrow-return-left text-primary fs-5"></i>

           

        </div>

    </div>


    {{-- Form --}}
    <div class="card-body p-4">

        <form action="{{ route('pengembalian.update', ['id_pengembalian' => $data->id_pengembalian]) }}"
              method="POST">

            @csrf
            @method('PUT')


            {{-- Peminjaman --}}
            <div class="mb-4">

                <label for="id_peminjaman" class="form-label fw-semibold">
                    Peminjaman
                </label>

                <select name="id_peminjaman"
                        id="id_peminjaman"
                        class="form-select rounded-3"
                        required>

                    <option value="">
                        -- Pilih Peminjaman --
                    </option>

                    @foreach($peminjaman as $item)

                        <option value="{{ $item->id_peminjaman }}"
                            {{ $data->id_peminjaman == $item->id_peminjaman ? 'selected' : '' }}>

                            #{{ $item->id_peminjaman }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Tanggal Pengembalian --}}
            <div class="mb-4">

                <label for="tanggal_pengembalian" class="form-label fw-semibold">
                    Tanggal Pengembalian
                </label>

                <input type="datetime-local"
                       name="tanggal_pengembalian"
                       id="tanggal_pengembalian"
                       class="form-control rounded-3"
                       value="{{ date('Y-m-d\TH:i', strtotime($data->tanggal_pengembalian)) }}"
                       required>

            </div>


            {{-- Grid --}}
            <div class="row">


                {{-- Terlambat --}}
                <div class="col-md-6 mb-4">

                    <label for="terlambat_hari" class="form-label fw-semibold">
                        Keterlambatan
                    </label>

                    <div class="input-group">

                        <input type="number"
                               name="terlambat_hari"
                               id="terlambat_hari"
                               class="form-control rounded-start-3"
                               value="{{ $data->terlambat_hari ?? 0 }}"
                               min="0"
                               required>

                        <span class="input-group-text rounded-end-3">
                            Hari
                        </span>

                    </div>

                </div>


                {{-- Denda --}}
                <div class="col-md-6 mb-4">

                    <label for="denda" class="form-label fw-semibold">
                        Denda
                    </label>

                    <div class="input-group">

                        <span class="input-group-text rounded-start-3">
                            Rp
                        </span>

                        <input type="number"
                               name="denda"
                               id="denda"
                               class="form-control rounded-end-3"
                               value="{{ $data->denda ?? 0 }}"
                               min="0"
                               required>

                    </div>

                </div>

            </div>


            {{-- Kondisi Barang --}}
            <div class="mb-4">

                <label for="kondisi_barang" class="form-label fw-semibold">
                    Kondisi Barang
                </label>

                <select name="kondisi_barang"
                        id="kondisi_barang"
                        class="form-select rounded-3"
                        required>

                    <option value="Baik"
                        {{ ($data->kondisi_barang ?? '') == 'Baik' ? 'selected' : '' }}>
                        Baik
                    </option>

                    <option value="Rusak Ringan"
                        {{ ($data->kondisi_barang ?? '') == 'Rusak Ringan' ? 'selected' : '' }}>
                        Rusak Ringan
                    </option>

                    <option value="Rusak Berat"
                        {{ ($data->kondisi_barang ?? '') == 'Rusak Berat' ? 'selected' : '' }}>
                        Rusak Berat
                    </option>

                </select>

            </div>


            {{-- Catatan --}}
            <div class="mb-4">

                <label for="catatan" class="form-label fw-semibold">
                    Catatan
                </label>

                <textarea name="catatan"
                          id="catatan"
                          rows="4"
                          class="form-control rounded-3"
                          placeholder="Tambahkan catatan jika diperlukan...">{{ $data->catatan ?? '' }}</textarea>

            </div>


            {{-- Tombol --}}
            <div class="d-flex flex-wrap gap-2 pt-2">

                <button type="submit"
                        class="btn btn-primary px-4 py-2 rounded-3 fw-semibold">

                    <i class="bi bi-check-circle me-1"></i>

                    Simpan Perubahan

                </button>


                <a href="{{ route('pengembalian.index') }}"
                   class="btn btn-secondary px-4 py-2 rounded-3 fw-semibold">

                    <i class="bi bi-arrow-left me-1"></i>

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

</div>

@endsection