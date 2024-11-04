<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(AboutSeeder::class);
        $this->call(AboutImageSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(ExploreSeeder::class);
        $this->call(ExploreImageSeeder::class);
        $this->call(HomeSeeder::class);
        $this->call(HomeImageSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(PackageImageSeeder::class);
        $this->call(PeopleSeeder::class);
        $this->call(TagaboutSeeder::class);
        $this->call(TagexploreSeeder::class);
        $this->call(TaghomeSeeder::class);
        $this->call(TagpackageSeeder::class);
        $this->call(UserSeeder::class);
    }
}
