<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;
use App\Models\produk;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = kategori::all();
        $produk = produk::all();
        return view('welcome', compact('kategori', 'produk'));
    }
}
