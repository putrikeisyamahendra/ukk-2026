<?php

namespace App\Controllers\Core;

use App\Models\User;
use App\Models\Peminjaman;
use Sakuci\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::current();

        if ($user && $user->role === 'petugas') {
            return $this->petugas();
        }

        if ($user && $user->role === 'admin') {
            return $this->admin();
        }

        return $this->peminjam();
    }

    public function admin()
{
    $semua = Peminjaman::all();

    $menunggu = 0;
    $dipinjam = 0;

    foreach ($semua as $p) {
        if ($p->status === 'Pending')   $menunggu++;
        if ($p->status === 'Disetujui') $dipinjam++;
    }

    $totalLog = count(\App\Models\LogAktivitas::all());

    return view('core.admin.dashboard', [
        'user'     => User::current(),
        'menunggu' => $menunggu,
        'dipinjam' => $dipinjam,
        'totalLog' => $totalLog,
    ]);
}

    public function petugas()
    {
        $user = User::current();
        $semua = Peminjaman::all();

        $menunggu = 0;
        $dipinjam = 0;
        $selesai  = 0;

        foreach ($semua as $p) {
            if ($p->status === 'Pending')      $menunggu++;
            if ($p->status === 'Disetujui')    $dipinjam++;
            if ($p->status === 'Dikembalikan') $selesai++;
        }

        return view('petugas.dashboard', compact('user', 'menunggu', 'dipinjam', 'selesai'));
    }

    public function peminjam()
    {
        $user = User::current();

        $semua = Peminjaman::where('id_user', $user->id)->get();

        $menunggu = 0;
        $dipinjam = 0;
        $selesai  = 0;
        $denda    = 0;

        foreach ($semua as $p) {
            if ($p->status === 'Pending')      $menunggu++;
            if ($p->status === 'Disetujui')    $dipinjam++;
            if ($p->status === 'Dikembalikan') $selesai++;
            $denda += (int) ($p->denda ?? 0);
        }

        return view('peminjam.dashboard', compact('user', 'menunggu', 'dipinjam', 'selesai', 'denda'));
    }
}