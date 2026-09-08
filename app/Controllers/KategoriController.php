<?php

namespace App\Controllers;
use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::orderBy('id_kategori', 'desc')->paginate(10);
        return view('kategori.index', compact('kategori'));
    }
    public function create(Request $request)
    {
        return view('kategori.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'nama_kategori' => 'required|string|max:255',
            'kode_kategori' => 'required|string|max:255',
        ]);

        Kategori::create([
            'keterangan' => $request->input('keterangan'),
            'nama_kategori' => $request->input('nama_kategori'),
            'kode_kategori' => $request->input('kode_kategori'),
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
}
