<?php

namespace Database\Factories;

use App\Models\Taghome;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaghomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Taghome::class;

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
