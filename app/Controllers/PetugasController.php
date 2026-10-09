<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use App\Models\Pengembalian;
use App\Models\LogAktivitas;

class PetugasController extends Controller
{
    // Daftar pengajuan yang menunggu
    public function persetujuan(Request $request)
    {
        $data  = Peminjaman::where('status', 'Pending')
            ->orderBy('id_peminjaman', 'desc')
            ->paginate(10);
        $users = User::all();
        $alat  = Alat::all();

        return view('petugas.persetujuan', compact('data', 'users', 'alat'));
    }

    // Setujui: stok berkurang di sini
    public function setujui(Request $request, $id_peminjaman)
    {
        $p = Peminjaman::findOrFail($id_peminjaman);

        if ($p->status !== 'Pending') {
            return redirect(route('petugas.persetujuan'))
                ->with('error', 'Pengajuan sudah diproses.');
        }

        $alat = Alat::findOrFail($p->id_alat);

        if ((int) $p->jumlah > (int) $alat->stok) {
            return redirect(route('petugas.persetujuan'))
                ->with('error', 'Stok tidak cukup. Sisa: ' . $alat->stok);
        }

        $alat->update(['stok' => (int) $alat->stok - (int) $p->jumlah]);
        $p->update(['status' => 'Disetujui']);

        LogAktivitas::catat('Menyetujui peminjaman #' . $p->id_peminjaman);

        return redirect(route('petugas.persetujuan'))
            ->with('success', 'Pengajuan disetujui.');
    }

    // Tolak: stok tidak berubah
    public function tolak(Request $request, $id_peminjaman)
    {
        $p = Peminjaman::findOrFail($id_peminjaman);

        if ($p->status === 'Pending') {
            $p->update(['status' => 'Ditolak']);
            LogAktivitas::catat('Menolak peminjaman #' . $p->id_peminjaman);
        }

        return redirect(route('petugas.persetujuan'))
            ->with('success', 'Pengajuan ditolak.');
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

       // Ubah kondisi barang (Baik / Rusak / Hilang) + hitung ulang denda
    public function kondisi(Request $request, $id_pengembalian)
    {
        $data = $request->validate([
            'kondisi_barang' => 'required|string|max:100',
            'catatan'        => 'nullable|string',
        ]);

        $baru = $data['kondisi_barang'];

        // Tarif denda (ubah sesuai kebijakan)
        $tarifTelat  = 5000;
        $dendaKondisi = ['Baik' => 0, 'Rusak' => 25000, 'Hilang' => 100000];

        if (! isset($dendaKondisi[$baru])) {
            return redirect(route('petugas.pemantauan'))
                ->with('error', 'Kondisi tidak valid.');
        }

        $pengembalian = Pengembalian::findOrFail($id_pengembalian);
        $peminjaman   = Peminjaman::findOrFail($pengembalian->id_peminjaman);
        $lama         = $pengembalian->kondisi_barang;

        // Total = denda telat + denda kondisi (dihitung ulang, tidak menumpuk)
        $total = ((int) $pengembalian->terlambat_hari * $tarifTelat) + $dendaKondisi[$baru];

        $data['denda'] = $total;
        $pengembalian->update($data);
        $peminjaman->update(['denda' => $total]);

        // Barang hilang tidak kembali ke stok
        $alat = Alat::findOrFail($peminjaman->id_alat);

        if ($lama !== 'Hilang' && $baru === 'Hilang') {
            $alat->update(['stok' => max(0, (int) $alat->stok - (int) $peminjaman->jumlah)]);
        } elseif ($lama === 'Hilang' && $baru !== 'Hilang') {
            $alat->update(['stok' => (int) $alat->stok + (int) $peminjaman->jumlah]);
        }

        LogAktivitas::catat(
            'Kondisi pengembalian #' . $id_pengembalian . ' menjadi ' . $baru .
            ', total denda Rp ' . number_format($total, 0, ',', '.')
        );

        return redirect(route('petugas.pemantauan'))
            ->with('success', 'Kondisi diperbarui. Total denda: Rp ' . number_format($total, 0, ',', '.'));
    }

        // Laporan peminjaman (bisa difilter dan dicetak)
    public function laporan(Request $request)
    {
        $query = Peminjaman::query();

        if ($request->dari) {
            $query->where('tanggal_pinjam', '>=', $request->dari);
        }

        if ($request->sampai) {
            $query->where('tanggal_pinjam', '<=', $request->sampai);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $data  = $query->orderBy('id_peminjaman', 'desc')->get();
        $users = User::all();
        $alat  = Alat::all();

        return view('petugas.laporan', compact('data', 'users', 'alat'));
    }
}