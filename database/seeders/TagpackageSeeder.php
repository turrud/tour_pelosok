<?php

namespace Database\Seeders;

use App\Models\Tagpackage;
use Illuminate\Database\Seeder;

class TagpackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tagpackage::factory()
            ->count(5)
            ->create();
    }
}
