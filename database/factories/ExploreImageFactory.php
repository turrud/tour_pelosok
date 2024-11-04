<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ExploreImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExploreImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExploreImage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => $this->faker->randomNumber(),
            'caption' => $this->faker->text(255),
            'explore_id' => \App\Models\Explore::factory(),
        ];
    }
}
