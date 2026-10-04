<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        $data = Pengembalian::orderBy('id_pengembalian', 'desc')->paginate(10);
        return view('pengembalian.index', compact('data'));
    }

    public function create(Request $request)
    {
        // Menampilkan peminjaman yang belum dikembalikan
        $peminjaman = Peminjaman::where('status', 'Disetujui')->get();
        return view('pengembalian.create', compact('peminjaman'));
    }

        public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        $peminjaman = Peminjaman::findOrFail($validatedData['id_peminjaman']);

        // Hanya peminjaman yang berstatus Disetujui yang bisa dikembalikan
        if ($peminjaman->status !== 'Disetujui') {
            return redirect(route('pengembalian.index'))
                ->with('error', 'Peminjaman ini tidak bisa diproses pengembaliannya.');
        }

        // Hitung keterlambatan dan denda otomatis
        $tarifPerHari = 5000; // ubah sesuai tarif yang kamu mau
        $rencana = strtotime($peminjaman->tanggal_kembali);
        $aktual  = strtotime($validatedData['tanggal_pengembalian']);

        $terlambat = $rencana ? max(0, (int) floor(($aktual - $rencana) / 86400)) : 0;
        $denda     = $terlambat * $tarifPerHari;

        $validatedData['terlambat_hari'] = $terlambat;
        $validatedData['denda']          = $denda;
        $validatedData['kondisi_barang'] = $validatedData['kondisi_barang'] ?? 'Baik';

        Pengembalian::create($validatedData);

        // Kembalikan stok
        $alat = \App\Models\Alat::findOrFail($peminjaman->id_alat);
        $alat->update(['stok' => (int) $alat->stok + (int) $peminjaman->jumlah]);

        // Tandai selesai dan simpan denda di data peminjaman
        $peminjaman->update(['status' => 'Dikembalikan', 'denda' => $denda]);

        return redirect(route('pengembalian.index'))->with('success', 'Pengembalian dicatat. Denda: Rp ' . number_format($denda, 0, ',', '.'));
    }
    public function edit(Request $request, $id_pengembalian)
    {
        $data = Pengembalian::findOrFail($id_pengembalian);
        $peminjaman = Peminjaman::all();
        return view('pengembalian.edit', compact('data', 'peminjaman'));
    }

    public function update(Request $request, $id_pengembalian)
    {
        $data = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'terlambat_hari'       => 'nullable|integer|min:0',
            'denda'                => 'nullable|integer|min:0',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        $pengembalian = Pengembalian::findOrFail($id_pengembalian);
        $pengembalian->update($data);
        
        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil diubah.');
    }

    public function delete(Request $request, $id_pengembalian)
    {
        $pengembalian = Pengembalian::findOrFail($id_pengembalian);
        $pengembalian->delete();

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus.');
    }
        // Halaman pengembalian milik peminjam (hanya lihat)
        // Halaman pengembalian milik peminjam (hanya lihat)
    
        // Halaman pengembalian milik peminjam (hanya lihat)
    public function pengembalian(Request $request)
    {
        $me = \App\Models\User::current();

        $data = Peminjaman::where('id_user', $me->id)
            ->whereIn('status', ['Disetujui', 'Dikembalikan'])
            ->orderBy('id_peminjaman', 'desc')
            ->get();

        $alat = \App\Models\Alat::all();

        return view('pengembalian.pengembalian', compact('data', 'alat'));
    }

    // Peminjam mengembalikan alat
    public function kembalikan(Request $request, $id_peminjaman)
    {
        $me = \App\Models\User::current();
        $p  = Peminjaman::findOrFail($id_peminjaman);

        if ((int) $p->id_user !== (int) $me->id) {
            return redirect(route('peminjam.pengembalian'))
                ->with('error', 'Ini bukan peminjaman kamu.');
        }

        if ($p->status !== 'Disetujui') {
            return redirect(route('peminjam.pengembalian'))
                ->with('error', 'Peminjaman ini tidak bisa dikembalikan.');
        }

        $hariIni   = date('Y-m-d');
        $rencana   = $p->tanggal_kembali ? strtotime($p->tanggal_kembali) : 0;
        $terlambat = $rencana ? max(0, (int) floor((strtotime($hariIni) - $rencana) / 86400)) : 0;
        $denda     = $terlambat * 5000;

        Pengembalian::create([
            'id_peminjaman'        => $p->id_peminjaman,
            'tanggal_pengembalian' => $hariIni,
            'terlambat_hari'       => $terlambat,
            'denda'                => $denda,
            'kondisi_barang'       => 'Baik',
            'catatan'              => 'Dikembalikan oleh peminjam',
        ]);

        $alat = \App\Models\Alat::findOrFail($p->id_alat);
        $alat->update(['stok' => (int) $alat->stok + (int) $p->jumlah]);

        $p->update(['status' => 'Dikembalikan', 'denda' => $denda]);

        $pesan = 'Alat berhasil dikembalikan.';
        if ($denda > 0) {
            $pesan .= ' Terlambat ' . $terlambat . ' hari, denda Rp ' . number_format($denda, 0, ',', '.') . '.';
        }

        return redirect(route('peminjam.pengembalian'))->with('success', $pesan);
    }
}