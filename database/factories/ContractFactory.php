<?php

namespace Database\Factories;

use App\Models\Beekeeper;
use App\Models\Contract;
use App\Models\Postcode;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lon'               => rand(470000, 480000) / 10000,
            'lat'               => rand( 80000,  90000) / 10000,
            'contact_firstname' => $this->faker->firstName,
            'contact_lastname'  => $this->faker->lastName,
            'contact_phone'     => rand(41760000000, 41799999999),
            'info'              => $this->faker->realText(60),
            'postcode_id'       => Postcode::all()->random()->id,
            'created_by'        => User::all()->where('is_admin')->random()->id,
            'beekeeper_id'      => rand(0,3) == 1 ? null : Beekeeper::all()->random()->id,
        ];
    }
}
