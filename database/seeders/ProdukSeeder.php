<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        produk::create([
            "nama" => "Laptop",
            "slug" => "laptop",
            "deskripsi" => "Laptop gaming dengan spesifikasi tinggi.",
            "harga" => 15000000,
            "gambar" => "laptop.jpg",
            "stok" => 10,
            "id_kategori" => 1,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        produk::create([
            "nama" => "Kaos",
            "slug" => "kaos",
            "deskripsi" => "Kaos cotton berkualitas tinggi.",
            "harga" => 75000,
            "gambar" => "kaos.jpg",
            "stok" => 50,
            "id_kategori" => 2,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        Produk::create([
            "nama" => "Sabun Mandi",
            "slug" => "sabun-mandi",
            "deskripsi" => "Sabun mandi herbal dengan aroma segar.",
            "harga" => 25000,
            "gambar" => "sabun.jpg",
            "stok" => 100,
            "id_kategori" => 3,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        Produk::create([
            "nama" => "Kopi",
            "slug" => "kopi",
            "deskripsi" => "Kopi Arabika premium dari dataran tinggi.",
            "harga" => 50000,
            "gambar" => "kopi.jpg",
            "stok" => 200,
            "id_kategori" => 4,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}
