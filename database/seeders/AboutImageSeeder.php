<?php

namespace Database\Seeders;

use App\Models\AboutImage;
use Illuminate\Database\Seeder;

class AboutImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutImage::factory()
            ->count(5)
            ->create();
    }
}
