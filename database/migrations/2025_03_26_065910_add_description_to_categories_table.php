<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tambahkan pengecekan agar tidak error jika kolom sudah ada
        if (!Schema::hasColumn('categories', 'description')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->text('description')->nullable()->after('name');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Cek dulu agar tidak error saat rollback
        if (Schema::hasColumn('categories', 'description')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }
    }
};
use App\Models\Category;

$category = new Category();
$category->name = 'Nama Kategori';
$category->description = 'Deskripsi kategori'; // Opsional
$category->save();
