<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'id_user',
        'total_harga',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function OrderProduks(){
        return $this->hasMany(OrderProduk::class);
    }
}
