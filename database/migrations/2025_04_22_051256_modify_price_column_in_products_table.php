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
        Schema::table('products', function (Blueprint $table) {
            // Mengubah kolom price agar lebih besar (12 digit, 2 desimal)
            $table->decimal('price', 12, 2)->change(); // Mengubah kolom price
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->change(); // Kembalikan ke tipe semula jika rollback
        });
    }
};
