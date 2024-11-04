<?php

namespace Database\Seeders;

use App\Models\HomeImage;
use Illuminate\Database\Seeder;

class HomeImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeImage::factory()
            ->count(5)
            ->create();
    }
}
