<?php

namespace Database\Seeders;

use App\Models\Taghome;
use Illuminate\Database\Seeder;

class TaghomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Taghome::factory()
            ->count(5)
            ->create();
    }
}
