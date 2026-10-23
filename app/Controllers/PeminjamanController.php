<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use App\Models\Pengembalian;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->search);

        $users = User::all();
        $alat  = Alat::all();

        if ($search !== '') {
            $kata = mb_strtolower($search);

            // Cari id user yang username-nya cocok
            $idUser = [];
            foreach ($users as $u) {
                if (mb_strpos(mb_strtolower((string) $u->username), $kata) !== false) {
                    $idUser[] = (int) $u->id;
                }
            }

            // Cari id alat yang nama_alat-nya cocok
            $idAlat = [];
            foreach ($alat as $a) {
                if (mb_strpos(mb_strtolower((string) $a->nama_alat), $kata) !== false) {
                    $idAlat[] = (int) $a->id_alat;
                }
            }

                        // Kumpulkan id peminjaman yang user atau alatnya cocok
            $idCocok = [];
            foreach (Peminjaman::all() as $pm) {
                if (in_array((int) $pm->id_user, $idUser, true)
                    || in_array((int) $pm->id_alat, $idAlat, true)) {
                    $idCocok[] = (int) $pm->id_peminjaman;
                }
            }

            // Hindari whereIn dengan array kosong
            if (empty($idCocok)) { $idCocok = [0]; }

            $data = Peminjaman::whereIn('id_peminjaman', $idCocok)
                ->orderBy('id_peminjaman', 'desc')
                ->paginate(10);
        } else {
            $data = Peminjaman::orderBy('id_peminjaman', 'desc')->paginate(10);
        }

        // Supaya pagination tetap membawa kata kunci pencarian
        if (method_exists($data, 'withQueryString')) {
            $data->withQueryString();
        }

        return view('peminjaman.index', compact('data', 'users', 'alat'));
    }

    public function create(Request $request)
    {
        // Biasanya butuh data user dan alat untuk pilihan dropdown di form
        $users = User::all();
        $alat = Alat::all();
        return view('peminjaman.create', compact('users', 'alat'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user'        => 'required|integer',
            'id_alat'        => 'required|integer',
            'jumlah'         => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
        ]);

        // Set status awal peminjaman
        $data['status'] = 'Pending';
        $data['denda'] = 0;

        Peminjaman::create($data);
        return redirect(route('peminjaman.index'))->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    public function edit(Request $request, $id_peminjaman)
    {
        $data = Peminjaman::findOrFail($id_peminjaman);
        $users = User::all();
        $alat = Alat::all();

        return view('peminjaman.edit', compact('data', 'users', 'alat'));
    }

    public function update(Request $request, $id_peminjaman)
    {
        $data = $request->all();

        $peminjaman = Peminjaman::findOrFail($id_peminjaman);
        $peminjaman->update($data);

        return redirect(route('peminjaman.index'))->with('success', 'Data peminjaman berhasil diubah.');
    }

    public function delete(Request $request, $id_peminjaman)
    {
        $peminjaman = Peminjaman::findOrFail($id_peminjaman);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }

    // Form pengajuan (peminjam)
    public function ajukan(Request $request)
    {
        $alat = Alat::all();
        return view('peminjaman.ajukan', compact('alat'));
    }

    // Simpan pengajuan: hanya cek stok, stok BELUM berkurang
    public function kirim(Request $request)
    {
        $me = User::current();

        $data = $request->validate([
            'id_alat'         => 'required|integer',
            'jumlah'          => 'required|integer|min:1',
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'nullable|date',
        ]);
        $alat = Alat::findOrFail($data['id_alat']);

        if ((int) $data['jumlah'] > (int) $alat->stok) {
            return redirect(route('peminjam.ajukan'))
                ->with('error', 'Jumlah melebihi stok tersedia (' . $alat->stok . ').');
        }

        $data['id_user'] = $me->id;
        $data['status']  = 'Pending';
        $data['denda']   = 0;

        Peminjaman::create($data);

        return redirect(route('peminjam.riwayat'))
            ->with('success', 'Pengajuan terkirim, menunggu persetujuan admin.');
    }

    // Riwayat milik peminjam sendiri
    public function riwayat(Request $request)
    {
        $me = User::current();

        $data = Peminjaman::where('id_user', $me->id)
            ->orderBy('id_peminjaman', 'desc')
            ->paginate(10);

        $alat = Alat::all();

        return view('peminjaman.riwayat', compact('data', 'alat'));
    }

    // Admin menyetujui: stok berkurang di sini
    public function setujui(Request $request, $id_peminjaman)
    {
        $p = Peminjaman::findOrFail($id_peminjaman);

        if ($p->status !== 'Pending') {
            return redirect(route('peminjaman.index'))
                ->with('error', 'Pengajuan ini sudah diproses.');
        }

        $alat = Alat::findOrFail($p->id_alat);

        // Cek stok sekali lagi (bisa saja sudah dipakai pengajuan lain)
        if ((int) $p->jumlah > (int) $alat->stok) {
            return redirect(route('peminjaman.index'))
                ->with('error', 'Stok tidak cukup. Sisa: ' . $alat->stok);
        }

        $alat->update(['stok' => (int) $alat->stok - (int) $p->jumlah]);
        $p->update(['status' => 'Disetujui']);

        return redirect(route('peminjaman.index'))->with('success', 'Pengajuan disetujui.');
    }

    // Admin menolak: stok tidak berubah
    public function tolak(Request $request, $id_peminjaman)
    {
        $p = Peminjaman::findOrFail($id_peminjaman);

        if ($p->status === 'Pending') {
            $p->update(['status' => 'Ditolak']);
        }

        return redirect(route('peminjaman.index'))->with('success', 'Pengajuan ditolak.');
    }

    public function kembalikan(Request $request, $id_peminjaman)
    {
        $me = User::current();
        $p  = Peminjaman::findOrFail($id_peminjaman);

        // Hanya pemilik peminjaman yang boleh mengembalikan
        if ((int) $p->id_user !== (int) $me->id) {
            return redirect(route('peminjam.riwayat'))
                ->with('error', 'Ini bukan peminjaman kamu.');
        }

        if ($p->status !== 'Disetujui') {
            return redirect(route('peminjam.riwayat'))
                ->with('error', 'Peminjaman ini tidak bisa dikembalikan.');
        }

        // Hitung keterlambatan dan denda (Rp5.000 per hari)
        $hariIni   = date('Y-m-d');
        $terlambat = 0;

        if ($p->tanggal_kembali) {
            $selisih   = (strtotime($hariIni) - strtotime($p->tanggal_kembali)) / 86400;
            $terlambat = $selisih > 0 ? (int) floor($selisih) : 0;
        }

        $denda = $terlambat * 5000;

        Pengembalian::create([
            'id_peminjaman'        => $p->id_peminjaman,
            'tanggal_pengembalian' => $hariIni,
            'terlambat_hari'       => $terlambat,
            'denda'                => $denda,
            'kondisi_barang'       => 'Baik',
            'catatan'              => 'Dikembalikan oleh peminjam',
        ]);

        // Stok kembali
        $alat = Alat::findOrFail($p->id_alat);
        $alat->update(['stok' => (int) $alat->stok + (int) $p->jumlah]);

        $p->update(['status' => 'Dikembalikan', 'denda' => $denda]);

        $pesan = 'Alat berhasil dikembalikan.';
        if ($denda > 0) {
            $pesan .= ' Terlambat ' . $terlambat . ' hari, denda Rp ' . number_format($denda, 0, ',', '.') . '.';
        }

        return redirect(route('peminjam.riwayat'))->with('success', $pesan);
    }
}
