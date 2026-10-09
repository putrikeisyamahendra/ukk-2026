<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\LogAktivitas;
use App\Models\User;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $query = LogAktivitas::query();

        if ($request->cari) {
            $query->where('aktivitas', 'like', '%' . $request->cari . '%');
        }

        $data   = $query->orderBy('id_log', 'desc')->paginate(15);
        $semua  = LogAktivitas::all();
        $users  = User::all();

        return view('admin.log', compact('data', 'semua', 'users'));
    }
}