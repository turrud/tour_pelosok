<?php

namespace Database\Seeders;

use App\Models\Explore;
use Illuminate\Database\Seeder;

class ExploreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Explore::factory()
            ->count(5)
            ->create();
    }
}
