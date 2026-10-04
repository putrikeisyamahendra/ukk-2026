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
        $data  = LogAktivitas::orderBy('id_log', 'desc')->paginate(15);
        $users = User::all();

        return view('admin.log', compact('data', 'users'));
    }
}