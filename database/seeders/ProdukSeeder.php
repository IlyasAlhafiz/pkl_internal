<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Redmi Note 14 Pro 5G',
                'slug' => 'redmi-note-14-pro-5g',
                'deskripsi' => 'Ini handphone terbaik di harganya untuk all rounder',
                'harga' => 4000000,
                'gambar' => 'produk/84iBS1eG5qlHuXJjRknUh4aJfLRkxmoDmq38TojB.webp',
                'stok' => 4098,
                'id_kategori' => 1,
            ],
            [
                'nama' => 'Poco F7',
                'slug' => 'poco-f7',
                'deskripsi' => 'Ini handphone terbaik untuk Gaming di harganya',
                'harga' => 5500000,
                'gambar' => 'produk/2XICQ65DaJia5vvCzulu9LZ3F11C5NU75BvRl7I2.webp',
                'stok' => 4000,
                'id_kategori' => 1,
            ],
            [
                'nama' => 'Poco F7 Ultra',
                'slug' => 'poco-f7-ultra',
                'deskripsi' => 'Ini Hp gaming terbaik untuk saat ini yang di buat Xiaomi',
                'harga' => 9999999,
                'gambar' => 'produk/npXEr59xPJwkA2MDVoR6w7hXfIXMxbhpaAKgMrn8.webp',
                'stok' => 20000,
                'id_kategori' => 1,
            ],
            [
                'nama' => 'Xiaomi 15 Ultra',
                'slug' => 'xiaomi-15-ultra',
                'deskripsi' => 'Ini termasuk hp dengan kamera terbaik saat ini (DSLR berkedok hp)',
                'harga' => 17000000,
                'gambar' => 'produk/gfrJ9Cllmo3TafqSC9p2uoSV6Q3PFtKnk5NgtqYO.webp',
                'stok' => 10000,
                'id_kategori' => 1,
            ],
            [
                'nama' => 'Xiaomi Watch 2',
                'slug' => 'xiaomi-watch-2',
                'deskripsi' => 'Ini jam tangan yang bagus untuk wanita pria',
                'harga' => 2599999,
                'gambar' => 'produk/N1Of0pONUuFslkPlkQsVFnqs8eRxO6AUOQZ8DI4C.webp',
                'stok' => 9995,
                'id_kategori' => 2,
            ],
            [
                'nama' => 'Redmi Watch 5',
                'slug' => 'redmi-watch-5',
                'deskripsi' => 'Ini jam tangan bagus untuk pria atau wanita dan harganya yang tidak terlalu mahal',
                'harga' => 1300000,
                'gambar' => 'produk/lteCRmPSgBZoxUBwgVPhZimQXH5lzHIDUemS56Zk.webp',
                'stok' => 8000,
                'id_kategori' => 2,
            ],
            [
                'nama' => 'Redmi Watch 5 Active',
                'slug' => 'redmi-watch-5-active',
                'deskripsi' => 'Ini jam tangan yang lebih bagus dari pendahulunya tapi harga jauh lebih murah',
                'harga' => 379000,
                'gambar' => 'produk/rPjt8NQbTK4t5z5ZXo7IjryCT56iKH5IL8vtApss.webp',
                'stok' => 6989,
                'id_kategori' => 2,
            ],
            [
                'nama' => 'Xiaomi Tv A55',
                'slug' => 'xiaomi-tv-a55',
                'deskripsi' => 'Ini televisi yang cocok di pake untuk nonton film bareng keluarga',
                'harga' => 1999999,
                'gambar' => 'produk/vx4fPLQE2c8pRYiyZ4C2Z52CsgP8UQBWYSBR3hqZ.webp',
                'stok' => 5000,
                'id_kategori' => 3,
            ],
            [
                'nama' => 'Xiaomi Tv A Pro 32',
                'slug' => 'xiaomi-tv-a-pro-32',
                'deskripsi' => 'Ini televisi yang cocok di pake untuk bermain game',
                'harga' => 2599999,
                'gambar' => 'produk/jmZkMkz5PwShnzplOAYpbWBBX0YQUcqZ0caQG6WP.webp',
                'stok' => 11999,
                'id_kategori' => 3,
            ],
            [
                'nama' => 'Xiaomi Tv  S Mini LED 75',
                'slug' => 'xiaomi-tv-s-mini-led-75',
                'deskripsi' => 'Ini televisi generasi terbaru dan membawa fitur yang lebih baik dari pendahulunya',
                'harga' => 2999999,
                'gambar' => 'produk/a02jr0GDxbic9uHY4MKIIAOgvBn0YfbLUlesh868.webp',
                'stok' => 15000,
                'id_kategori' => 3,
            ],
        ];

        foreach ($data as $item) {
            Produk::create($item);
        }
    }
}
