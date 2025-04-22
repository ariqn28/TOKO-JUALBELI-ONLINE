<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder; // ← ini penting

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategorySeeder::class,
        ]);
    }
}
