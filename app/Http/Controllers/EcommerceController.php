<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;
use App\Models\produk;

class EcommerceController extends Controller
{
    public function index()
    {
        $kategori = kategori::all();
        $produk = produk::all();
        return view('welcome', compact('kategori', 'produk'));
    }

    public function createOrder(Request $request){

    }

    public function myOrders(){

    }

    public function orderDetail($id){

    }

    public function updateQuantity(Request $request){

    }

    public function removeItem(Request $request){

    }

    public function checkOut(Request $request){

    }
}
