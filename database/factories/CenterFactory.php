<?php

namespace Database\Factories;

use App\Models\Center;
use Illuminate\Database\Eloquent\Factories\Factory;

class CenterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Center::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'      => $this->faker->words(3,true),
            'address'   => $this->faker->address,
            'phone'     => $this->faker->phoneNumber,
            'note'      => $this->faker->sentence(15)
        ];
    }
}
