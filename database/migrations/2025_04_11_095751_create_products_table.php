<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama produk
            $table->text('description'); // Deskripsi produk
            $table->decimal('price', 8, 2); // Harga produk
            $table->integer('stock'); // Stok produk
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Relasi ke tabel categories
            $table->string('image')->nullable(); // Gambar produk (opsional)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
