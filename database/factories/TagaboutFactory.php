<?php

namespace Database\Factories;

use App\Models\Tagabout;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagaboutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tagabout::class;

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
