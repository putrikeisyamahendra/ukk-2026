@extends('layouts.app')

@section('title', 'Manage User')

@section('content')

<style>
.user-hero { position: relative; min-height: 220px; display: flex; align-items: center; overflow: hidden; border-radius: 24px; background: linear-gradient(135deg, var(--bs-body-bg), var(--bs-secondary-bg)); color: var(--bs-body-color); }
.user-hero::before { content: ""; position: absolute; width: 420px; height: 420px; background: rgba(13,110,253,.08); border-radius: 50%; top: -180px; left: -130px; }
.user-hero::after { content: ""; position: absolute; width: 330px; height: 330px; background: rgba(255,193,7,.10); border-radius: 50%; bottom: -160px; right: -100px; }
.user-content { position: relative; z-index: 2; width: 100%; padding: 35px 30px; }

.badge-volley { background: linear-gradient(135deg, #0d6efd, #084298); color: #fff; font-weight: 600; box-shadow: 0 6px 18px rgba(13,110,253,.25); }
.user-title { color: var(--bs-heading-color); letter-spacing: -1px; }
.text-volley { background: linear-gradient(90deg, #0d6efd, #084298); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.user-description { color: var(--bs-secondary-color); line-height: 1.8; }
.volley-line { width: 65px; height: 4px; margin: 0 0 22px; border-radius: 10px; background: linear-gradient(90deg, #0d6efd, #ffc107); }

.user-card { border-radius: 20px; background: color-mix(in srgb, var(--bs-body-bg) 85%, transparent); border: 1px solid var(--bs-border-color); box-shadow: 0 12px 35px rgba(0,0,0,.08); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); overflow: hidden; }
.user-card-header { padding: 20px; background: color-mix(in srgb, var(--bs-body-bg) 70%, transparent); border-bottom: 1px solid var(--bs-border-color); }
.user-card-body { padding: 24px; }

.form-control, .form-select { border-radius: 10px; background: color-mix(in srgb, var(--bs-body-bg) 75%, transparent); }
.form-control:focus, .form-select:focus { border-color: #0d6efd; box-shadow: 0 0 0 .2rem rgba(13,110,253,.15); }

.btn-volley { border: none; border-radius: 12px; font-weight: 700; color: #fff; background: linear-gradient(135deg, #0d6efd, #084298); box-shadow: 0 7px 18px rgba(13,110,253,.22); transition: all .3s ease; }
.btn-volley:hover { color: #fff; transform: translateY(-3px); box-shadow: 0 11px 25px rgba(13,110,253,.32); }

.user-table { color: var(--bs-body-color); vertical-align: middle; }
.user-table thead th { color: var(--bs-secondary-color); background: color-mix(in srgb, var(--bs-body-bg) 50%, transparent); border-bottom: 1px solid var(--bs-border-color); font-size: .85rem; }
.user-table tbody tr { background: transparent; transition: background-color .3s ease; }
.user-table tbody tr:hover { background: rgba(13,110,253,.05); }
.username { color: #0d6efd; font-weight: 600; }
.role-badge { display: inline-block; padding: 5px 10px; border-radius: 8px; color: #fff; background: linear-gradient(135deg, #0d6efd, #084298); font-size: .8rem; font-weight: 600; }

.volleyball { position: absolute; width: 85px; height: 85px; border-radius: 50%; background: var(--bs-body-bg); border: 4px solid var(--bs-heading-color); box-shadow: 0 12px 28px rgba(0,0,0,.15); z-index: 1; opacity: .95; }
.volleyball::before { content: ""; position: absolute; width: 68px; height: 34px; border-top: 5px solid #0d6efd; border-radius: 50%; top: 14px; left: 4px; transform: rotate(35deg); }
.volleyball::after { content: ""; position: absolute; width: 56px; height: 28px; border-bottom: 5px solid #ffc107; border-radius: 50%; bottom: 14px; right: 4px; transform: rotate(-35deg); }
.ball-one { top: 20px; right: 12%; animation: floating 4s ease-in-out infinite; }
.ball-two { bottom: 20px; left: 8%; width: 60px; height: 60px; animation: floating 5s ease-in-out infinite reverse; }
.ball-two::before { width: 48px; height: 24px; border-width: 4px; }
.ball-two::after { width: 40px; height: 20px; border-width: 4px; }

@keyframes floating { 0%,100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-15px) rotate(8deg); } }

[data-bs-theme="dark"] .user-hero { background: linear-gradient(135deg, var(--bs-body-bg), #172033); }
[data-bs-theme="dark"] .user-card { background: rgba(255,255,255,.05); box-shadow: 0 12px 35px rgba(0,0,0,.30); }
[data-bs-theme="dark"] .user-card-header { background: rgba(255,255,255,.03); }
[data-bs-theme="dark"] .form-control, [data-bs-theme="dark"] .form-select { background: rgba(255,255,255,.05); }
[data-bs-theme="dark"] .user-hero::before { background: rgba(13,110,253,.12); }
[data-bs-theme="dark"] .user-hero::after { background: rgba(255,193,7,.08); }

@media (max-width: 768px) {
    .user-hero { min-height: 260px; }
    .user-content { padding: 30px 20px; }
    .user-card-body { padding: 18px; }
    .volleyball { width: 60px; height: 60px; }
    .volleyball::before { width: 48px; height: 24px; border-width: 4px; }
    .volleyball::after { width: 40px; height: 20px; border-width: 4px; }
    .ball-one { top: 15px; right: 5%; }
    .ball-two { bottom: 15px; left: 5%; }
}
</style>

<div class="container py-3 py-lg-4">

    {{-- HEADER --}}
    <section class="user-hero mb-4">

        <div class="volleyball ball-one"></div>
        <div class="volleyball ball-two"></div>

        <div class="user-content">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <div>
                    <span class="badge rounded-pill badge-volley px-4 py-2 mb-3">🏐 AREA ADMIN</span>
                    <div class="volley-line"></div>
                    <h1 class="display-5 fw-bold mb-3 user-title">
                        Manage <span class="text-volley">User</span>
                    </h1>
                    <p class="lead user-description mb-0">
                        Kelola pengguna dan role yang digunakan dalam sistem.
                    </p>
                </div>

                <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 12px;">
                    &larr; Kembali
                </a>
            </div>
        </div>

    </section>

    <div class="row g-4">

        {{-- TAMBAH USER --}}
        <div class="col-md-5">
            <div class="user-card h-100">

                <div class="user-card-header">
                    <h2 class="h6 mb-0 fw-bold">Tambah User Baru</h2>
                </div>

                <div class="user-card-body">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}"
                                   class="form-control {{ errors()->has('username') ? 'is-invalid' : '' }}" autofocus>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password"
                                   class="form-control {{ errors()->has('password') ? 'is-invalid' : '' }}">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="role">Role</label>
                            <select id="role" name="role"
                                    class="form-select {{ errors()->has('role') ? 'is-invalid' : '' }}">
                                @foreach ($roles as $roleOption)
                                    <option value="{{ $roleOption->name }}"
                                            @if (old('role') === $roleOption->name) selected @endif>
                                        {{ $roleOption->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="form-text">
                                Butuh role lain? Tambahkan dulu di
                                <a href="{{ route('admin.roles.index') }}">Manage Role</a>.
                            </div>
                        </div>

                        <button class="btn btn-volley w-100" type="submit">Tambah User</button>
                    </form>
                </div>

            </div>
        </div>

        {{-- DAFTAR USER --}}
        <div class="col-md-7">
            <div class="user-card">

                <div class="user-card-header">
                    <h2 class="h6 mb-0 fw-bold">Daftar User</h2>
                </div>

                <div class="user-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0 user-table">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($users as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><span class="username">{{ $item->username }}</span></td>
                                        <td><span class="role-badge">{{ $item->role }}</span></td>
                                        <td class="text-end">
                                            <form method="POST"
                                                  action="{{ route('admin.users.destroy', ['id' => $item->id]) }}"
                                                  class="d-inline mb-0"
                                                  onsubmit="return confirm('Hapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 9px;">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-secondary text-center py-4">Belum ada user.</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection