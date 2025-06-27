<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [                                
        'nama',
        'slug',
    ];
    public function produk()
    {
        return $this->hasMany(produk::class, 'id_kategori');
    }
}
