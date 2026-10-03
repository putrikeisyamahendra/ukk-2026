<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;

class PeminjamanController extends Controller
{
    public function index(Request $request)
{
    $data = Peminjaman::orderBy('id_peminjaman', 'desc')->paginate(10);
    $users = User::all();
    $alat = Alat::all();

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
}