<?php

namespace App\Controllers\Core;

use App\Models\Role;
use App\Models\User;
use Sakuci\Controller;
use Sakuci\Http\Request;

/** Halaman admin untuk menambah user dan menentukan role-nya. */
class UserController extends Controller
{
    public function index()
    {
        return view('core.admin.users.index', [
            'users' => User::orderBy('username')->get(),
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|min:3|max:50|alpha_dash|unique:users,username',
            'password' => 'required|min:6',
            'role'     => 'required|exists:roles,name',
        ]);

        User::create([
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role'     => $data['role'],
        ]);

        return back()->with('success', 'User "' . $data['username'] . '" berhasil ditambahkan.');
    }

        public function destroy(Request $request, $id)
    {
        $me = User::current();

        if ((int) $me->id === (int) $id) {
            return redirect(route('admin.users.index'))
                ->with('error', 'Kamu tidak bisa menghapus akunmu sendiri.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect(route('admin.users.index'))
            ->with('success', 'User berhasil dihapus.');
    }
}

