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
            // Hanya tambahkan kolom jika belum ada
            if (!Schema::hasColumn('products', 'stock')) {
                $table->integer('stock')->default(0)->after('price');
            }

            if (!Schema::hasColumn('products', 'status')) {
                $table->string('status')->default('available')->after('stock');
            }
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
            // Hapus kolom jika rollback migrasi
            $table->dropColumn(['stock', 'status']);
        });
    }
};
