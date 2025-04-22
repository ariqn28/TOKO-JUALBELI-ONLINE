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
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'slug')) {
                $table->string('slug')->unique()->after('name');
            }
            if (!Schema::hasColumn('categories', 'description')) {
                $table->text('description')->nullable()->after('slug');
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
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'slug')) {
                $table->dropColumn('slug');
            }
            if (Schema::hasColumn('categories', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};
