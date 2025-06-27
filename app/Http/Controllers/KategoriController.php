<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = kategori::latest()->get();
        return view("admin.kategori.index", compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = kategori::latest()->get();
        return view('admin.kategori.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris,nama',
        ]);

        $kategori = new kategori();
        $kategori->nama = $request->nama;
        $kategori->slug = Str::slug($request->nama);
        $kategori->save();
        return redirect()->route('admin.kategori.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris,nama,' . $kategori->id,
        ]);

        $kategori->nama = $request->nama;
        $kategori->slug = Str::slug($request->nama);
        $kategori->save();
        return redirect()->route('admin.kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('admin.kategori.index');
    }
}
