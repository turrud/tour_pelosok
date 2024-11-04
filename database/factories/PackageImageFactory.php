<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PackageImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PackageImage::class;

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
            'package_id' => \App\Models\Package::factory(),
        ];
    }
}
