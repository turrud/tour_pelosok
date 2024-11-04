<?php

namespace Database\Factories;

use App\Models\HomeImage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomeImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HomeImage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => $this->faker->randomNumber(0),
            'caption' => $this->faker->name(),
            'home_id' => \App\Models\Home::factory(),
        ];
    }
}
