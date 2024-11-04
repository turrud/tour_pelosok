<?php

namespace Database\Seeders;

use App\Models\Tagabout;
use Illuminate\Database\Seeder;

class TagaboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tagabout::factory()
            ->count(5)
            ->create();
    }
}
