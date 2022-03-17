<?php

namespace Database\Factories;


use App\Models\Beekeeper;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BeekeeperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Beekeeper::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname'         => $this->faker->firstName,
            'lastname'          => $this->faker->lastName,
            'phone'             => rand(41760000000, 41799999999),
            'phone_verified_at' => now(),
        ];
    }
}
