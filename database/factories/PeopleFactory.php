<?php

namespace Database\Factories;

use App\Models\People;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\VarDumper\Caster\ImgStub;

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
        // $images = 'https://res.cloudinary.com/djzee3t99/image/upload/v1708606965/ddn/img/team/id-rifqi.png';

        return [
            'order_number' => $this->faker->randomNumber(0),
            'name' => 'Ahmad Ghazy',
            'job_title' => 'CEO & CTO',
        ];
    }
}