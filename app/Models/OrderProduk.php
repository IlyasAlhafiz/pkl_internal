<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\order;
use App\Models\produk;

class OrderProduk extends Model
{
    protected $fillable = [
        'id_order',
        'id_produk',
        'quantity',
        'subtotal',
    ];

    public function order()
    {
        return $this->belongsTo(order::class, 'id_order');
    }

    public function produk()
    {
        return $this->belongsTo(produk::class, 'id_produk');
    }
}
