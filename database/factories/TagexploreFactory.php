<?php

namespace Database\Factories;

use App\Models\Tagexplore;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagexploreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tagexplore::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->unique->slug(),
        ];
    }
}
