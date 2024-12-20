<?php

namespace Database\Factories;

use App\Models\Paket;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Paket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'fasilitas' => $this->faker->text(),
            'price' => $this->faker->randomNumber(),
        ];
    }
}
