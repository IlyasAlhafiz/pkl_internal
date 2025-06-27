<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'gambar',
        'stok',
        'id_kategori',
    ];

    /**
     * Get the kategori that owns the produk.
     */
    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'id_kategori');
    }
}
