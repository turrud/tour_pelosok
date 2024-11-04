<?php

namespace Database\Seeders;

use App\Models\ExploreImage;
use Illuminate\Database\Seeder;

class ExploreImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExploreImage::factory()
            ->count(5)
            ->create();
    }
}
