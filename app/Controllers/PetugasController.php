<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;

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

        return redirect(route('petugas.persetujuan'))->with('success', 'Pengajuan ditolak.');
    }
}