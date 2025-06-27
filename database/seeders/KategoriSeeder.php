<?php

namespace Database\Seeders;

use App\Models\kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        kategori::create([
            "nama"=> "Elektronik",
            "slug"=> "elektronik",
            "created_at"=> now(),
            "updated_at"=> now(),
            ]);
            
        kategori::create([
            "nama"=> "Pakaian",
            "slug"=> "pakaian",
            "created_at"=> now(),
            "updated_at"=> now(),
            ]);
        
        kategori::create([
            "nama"=> "Kehidupan",
            "slug"=> "kehidupan",
            "created_at"=> now(),
            "updated_at"=> now(),
            ]);

        kategori::create([
            "nama"=> "Makanan Minuman",
            "slug"=> "makanan-minuman",
            "created_at"=> now(),
            "updated_at"=> now(),
            ]);   
    }
}
