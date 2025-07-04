<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Handphone', 'slug' => 'handphone'],
            ['nama' => 'Jam Tangan', 'slug' => 'jam-tangan'],
            ['nama' => 'Televisi', 'slug' => 'televisi'],
        ];

        foreach ($data as $item) {
            Kategori::create($item);
        }
    }
}
