<?php

namespace Database\Seeders;

use App\Models\Tagexplore;
use Illuminate\Database\Seeder;

class TagexploreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tagexplore::factory()
            ->count(5)
            ->create();
    }
}
