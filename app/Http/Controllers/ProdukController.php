<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::with('kategori')->orderBy('id','desc')->get();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = kategori::all();
        return view('admin.produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:produks,nama',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:2',
            'id_kategori' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk', 'public');
        }

        $produk = new Produk();
        $produk->nama = $request->nama;
        $produk->slug = Str::slug($request->nama);
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->id_kategori = $request->id_kategori;
        $produk->gambar = $gambarPath;
        $produk->save();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(produk $produk)
    {
        $kategori = kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, produk $produk)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:produks,nama,' . $produk->id,
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:2',
            'id_kategori' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        $gambarPath = $produk->gambar;
        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $gambarPath = $request->file('gambar')->store('produk', 'public');
        }

        $produk->nama = $request->nama;
        $produk->slug = Str::slug($request->nama);
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->id_kategori = $request->id_kategori;
        $produk->gambar = $gambarPath;
        $produk->save();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(produk $produk)
    {
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }
        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus!');
    }

}