<?php

use App\Controllers\Core\AuthController;
use App\Controllers\Core\DashboardController;
use App\Controllers\Core\DatabaseController;
use App\Controllers\Core\DocsController;
use App\Controllers\Core\RoleController;
use App\Controllers\Core\UserController;
use App\Controllers\KategoriController;
use App\Controllers\AlatController;
use App\Controllers\PeminjamanController;
use App\Controllers\PengembalianController;
use App\Controllers\PetugasController;
use App\Controllers\LogController;
use Sakuci\Route;

/*
|--------------------------------------------------------------------------
| Route Web
|--------------------------------------------------------------------------
| Daftarkan seluruh route aplikasi di sini.
|
| Cara menulis action:
|   [HomeController::class, 'index']   -> disarankan
|   'HomeController@index'             -> namespace App\Controllers otomatis
|   function () { ... }                -> closure
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/docs', [DocsController::class, 'index'])->name('docs');

/*
|--------------------------------------------------------------------------
| Login multi-role
|--------------------------------------------------------------------------
| Lihat /docs untuk penjelasan lengkap langkah demi langkah.
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.attempt')->middleware('guest');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
Route::get('/', [DashboardController::class, 'admin'])->name('admin.dashboard');
Route::get('/log', [LogController::class, 'index'])->name('admin.log');

    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/database/export', [DatabaseController::class, 'export'])->name('admin.database.export');
    
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/edit/{id_kategori}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/update/{id_kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/destroy/{id_kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    
    Route::get('/alat', [alatController::class, 'index'])->name('alat.index');
    Route::get('/alat/create', [alatController::class, 'create'])->name('alat.create');
    Route::post('/alat/store', [alatController::class, 'store'])->name('alat.store');
    Route::get('/alat/{id_alat}/edit', [alatController::class, 'edit'] )->name('alat.edit');
    Route::put('/alat/{id_alat}', [alatController::class, 'update'] )->name('alat.update');
    Route::delete('/alat/{id_alat}', [alatController::class, 'delete'] )->name('alat.delete');

    Route::get('/peminjaman', [peminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [peminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman/store', [peminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/{id_peminjaman}/edit', [peminjamanController::class, 'edit'])->name('peminjaman.edit');
    Route::put('/peminjaman/{id_peminjaman}', [peminjamanController::class, 'update'])->name('peminjaman.update');
    Route::delete('/peminjaman/{id_peminjaman}', [peminjamanController::class, 'delete'])->name('peminjaman.delete');
    Route::put('/peminjaman/{id_peminjaman}/setujui', [peminjamanController::class, 'setujui'])->name('peminjaman.setujui');
    Route::put('/peminjaman/{id_peminjaman}/tolak', [peminjamanController::class, 'tolak'])->name('peminjaman.tolak');

    Route::get('/pengembalian', [pengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('/pengembalian/create', [pengembalianController::class, 'create'])->name('pengembalian.create');
    Route::post('/pengembalian/store', [pengembalianController::class, 'store'])->name('pengembalian.store');
    Route::get('/pengembalian/{id_pengembalian}/edit', [pengembalianController::class, 'edit'])->name('pengembalian.edit');
    Route::put('/pengembalian/{id_pengembalian}', [pengembalianController::class, 'update'])->name('pengembalian.update');
    Route::delete('/pengembalian/{id_pengembalian}', [pengembalianController::class, 'delete'])->name('pengembalian.delete');

    });

/*
|--------------------------------------------------------------------------
| Route role dinamis
|--------------------------------------------------------------------------
| Blok di bawah ini dikelola otomatis oleh RoleController saat admin
| menambah, mengganti nama, atau menghapus role lewat /admin/roles.
| Jangan diedit manual -- perubahan bisa tertimpa.
*/

// @generated-roles:start

// @role:peminjam:start
Route::group(['prefix' => 'peminjam', 'middleware' => 'peminjam'], function () {
    Route::get('/', [DashboardController::class, 'peminjam'])->name('peminjam.dashboard');
});
// @role:peminjam:end
// @generated-roles:end

Route::group(['prefix' => 'peminjam', 'middleware' => 'peminjam'], function () {
    Route::get('/kategori', [KategoriController::class, 'daftar'])->name('peminjam.kategori');
    Route::get('/daftar-alat', [AlatController::class, 'katalog'])->name('alat.katalog');
    Route::get('/ajukan', [PeminjamanController::class, 'ajukan'])->name('peminjam.ajukan');
    Route::post('/ajukan', [PeminjamanController::class, 'kirim'])->name('peminjam.kirim');
    Route::get('/riwayat', [PeminjamanController::class, 'riwayat'])->name('peminjam.riwayat');
    Route::get('/pengembalian', [PengembalianController::class, 'pengembalian'])->name('peminjam.pengembalian');
    Route::get('/beranda', [DashboardController::class, 'peminjam'])->name('peminjam.beranda');
    Route::post('/kembalikan/{id_peminjaman}', [PengembalianController::class, 'kembalikan'])->name('peminjam.kembalikan');
});

Route::group(['prefix' => 'petugas', 'middleware' => 'petugas'], function () {
    Route::get('/persetujuan', [PetugasController::class, 'persetujuan'])->name('petugas.persetujuan');
    Route::put('/persetujuan/{id_peminjaman}/setujui', [PetugasController::class, 'setujui'])->name('petugas.setujui');
    Route::put('/persetujuan/{id_peminjaman}/tolak', [PetugasController::class, 'tolak'])->name('petugas.tolak');

    Route::get('/pemantauan', [PetugasController::class, 'pemantauan'])->name('petugas.pemantauan');
    Route::put('/pemantauan/{id_pengembalian}/kondisi', [PetugasController::class, 'kondisi'])->name('petugas.kondisi');
    Route::get('/laporan', [PetugasController::class, 'laporan'])->name('petugas.laporan');
});

/*
|--------------------------------------------------------------------------
| Contoh (hapus/ubah sesuai kebutuhan)
|--------------------------------------------------------------------------
|
| use App\Controllers\BukuController;
|
| Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
|
| // Tujuh route CRUD sekaligus: index, create, store, show, edit, update, destroy
| // Route::resource
|
| // Group dengan prefix dan middleware bersama
| Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
|     Route::get('/dashboard', [DashboardController::class, 'index']);
| });
*/
