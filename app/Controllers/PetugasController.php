<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use App\Models\Pengembalian;

class PetugasController extends Controller
{
    public function persetujuan(Request $request)
    {
        $data  = Peminjaman::where('status', 'Pending')
            ->orderBy('id_peminjaman', 'desc')
            ->paginate(10);
        $users = User::all();
        $alat  = Alat::all();

        return view('petugas.persetujuan', compact('data', 'users', 'alat'));
    }

    public function setujui(Request $request, $id_peminjaman)
    {
        $p = Peminjaman::findOrFail($id_peminjaman);

        if ($p->status !== 'Pending') {
            return redirect(route('petugas.persetujuan'))->with('error', 'Pengajuan sudah diproses.');
        }

        $alat = Alat::findOrFail($p->id_alat);

        if ((int) $p->jumlah > (int) $alat->stok) {
            return redirect(route('petugas.persetujuan'))
                ->with('error', 'Stok tidak cukup. Sisa: ' . $alat->stok);
        }

        $alat->update(['stok' => (int) $alat->stok - (int) $p->jumlah]);
        $p->update(['status' => 'Disetujui']);

        return redirect(route('petugas.persetujuan'))->with('success', 'Pengajuan disetujui.');
    }

    public function tolak(Request $request, $id_peminjaman)
    {
        $p = Peminjaman::findOrFail($id_peminjaman);

        if ($p->status === 'Pending') {
            $p->update(['status' => 'Ditolak']);
        }
        if ($p->status === 'Pending') {
    $p->update(['status' => 'Ditolak']);
    \App\Models\LogAktivitas::catat('Menolak peminjaman #' . $p->id_peminjaman);
}

        return redirect(route('petugas.persetujuan'))->with('success', 'Pengajuan ditolak.');
    }

        // Pantau alat yang dipinjam dan yang sudah kembali
    public function pemantauan(Request $request)
    {
        $dipinjam = Peminjaman::where('status', 'Disetujui')
            ->orderBy('id_peminjaman', 'desc')
            ->get();

        $kembali = Pengembalian::orderBy('id_pengembalian', 'desc')->paginate(10);

        $users      = User::all();
        $alat       = Alat::all();
        $peminjaman = Peminjaman::all();

        return view('petugas.pemantauan', compact('dipinjam', 'kembali', 'users', 'alat', 'peminjaman'));
    }

    // Ubah kondisi barang (Baik / Rusak / Hilang)
    public function kondisi(Request $request, $id_pengembalian)
    {
        $data = $request->validate([
            'kondisi_barang' => 'required|string|max:100',
            'catatan'        => 'nullable|string',
        ]);

        if (! in_array($data['kondisi_barang'], ['Baik', 'Rusak', 'Hilang'])) {
            return redirect(route('petugas.pemantauan'))
                ->with('error', 'Kondisi tidak valid.');
        }

        $pengembalian = Pengembalian::findOrFail($id_pengembalian);
        $pengembalian->update($data);

        return redirect(route('petugas.pemantauan'))
            ->with('success', 'Kondisi barang diperbarui.');
    }
}