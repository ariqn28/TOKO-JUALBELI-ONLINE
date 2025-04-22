<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();

        // Daftar kategori
        $categories = [
            ['name' => 'Elektronik', 'image' => 'categories/elektronik.jpg'],
            ['name' => 'Kendaraan', 'image' => 'categories/kendaraan.jpg'],
            ['name' => 'Fashion & Aksesoris', 'image' => 'categories/fashion.jpg'],
            ['name' => 'Rumah & Properti', 'image' => 'categories/rumah-tangga.jpg'],
            ['name' => 'Kesehatan & Kecantikan', 'image' => 'categories/kesehatan.jpg'],
            ['name' => 'Hobi & Koleksi', 'image' => 'categories/hobi.jpg'],
            ['name' => 'Peralatan Rumah Tangga', 'image' => 'categories/peralatan.jpg'],
            ['name' => 'Perlengkapan Bayi & Anak', 'image' => 'categories/bayi.jpg'],
            ['name' => 'Komputer & Laptop', 'image' => 'categories/komputer.jpg'],
            ['name' => 'Handphone & Tablet', 'image' => 'categories/handphone.jpg'],
            ['name' => 'Kamera & Fotografi', 'image' => 'categories/kamera.jpg'],
            ['name' => 'Game & Konsol', 'image' => 'categories/game.jpg'],
            ['name' => 'Buku & Alat Tulis', 'image' => 'categories/buku.jpg'],
            ['name' => 'Alat Musik', 'image' => 'categories/musik.jpg'],
            ['name' => 'Olahraga & Outdoor', 'image' => 'categories/olahraga.jpg'],
            ['name' => 'Jasa & Layanan', 'image' => 'categories/jasa.jpg'],
            ['name' => 'Makanan & Minuman', 'image' => 'categories/makanan.jpg'],
            ['name' => 'Lowongan Kerja', 'image' => 'categories/kerja.jpg'],
            ['name' => 'Tiket & Voucher', 'image' => 'categories/tiket.jpg'],
            ['name' => 'Barang Antik & Langka', 'image' => 'categories/antik.jpg'],
        ];

        // Loop dan buat data
        foreach ($categories as $category) {
            $slug = Str::slug($category['name']);
            $deskripsi = 'Kategori ' . $category['name'] . ' berisi produk-produk pilihan yang berkaitan.';
            $createdBy = 1; // Ganti dengan random user ID jika tersedia

            $result = Category::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $category['name'],
                    'slug' => $slug,
                    'image' => $category['image'],
                    'description' => $deskripsi,
                    'created_by' => $createdBy
                ]
            );

            echo "✔️  Kategori '{$result->name}' berhasil ditambahkan.\n";
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
