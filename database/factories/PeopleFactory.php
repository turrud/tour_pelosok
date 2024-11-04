<?php

namespace Database\Factories;

use App\Models\People;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeopleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = People::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => $this->faker->randomNumber(0),
            'name' => $this->faker->name(),
            'job_title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
        ];
    }
}
