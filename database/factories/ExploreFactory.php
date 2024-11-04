<?php

namespace Database\Factories;

use App\Models\Explore;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExploreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Explore::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
            'main_image' => $this->faker->text(255),
        ];
    }
}
