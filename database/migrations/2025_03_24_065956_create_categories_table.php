<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // ID kategori
            $table->string('name'); // Nama kategori
            $table->string('slug')->unique(); // Slug SEO
            $table->text('description')->nullable(); // Deskripsi
            $table->string('image')->nullable(); // Gambar kategori
            $table->unsignedBigInteger('created_by')->nullable(); // User yang membuat
            $table->timestamps(); // created_at dan updated_at
        });

        // Tambahkan foreign key untuk created_by
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        // Nonaktifkan foreign key check agar tidak error saat rollback
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::dropIfExists('categories');

        // Aktifkan kembali foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
