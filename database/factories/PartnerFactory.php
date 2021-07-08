<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Partner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'      => $this->faker->words(5,true),
            'phone'     => $this->faker->phoneNumber,
            'email'     => $this->faker->unique()->safeEmail,
            'password'  => bcrypt('password'),
        ];
    }
}
