<?php

namespace Database\Seeders;

use App\Models\PackageImage;
use Illuminate\Database\Seeder;

class PackageImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PackageImage::factory()
            ->count(5)
            ->create();
    }
}
