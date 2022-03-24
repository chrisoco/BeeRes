<?php

namespace Database\Seeders;

use App\Models\Beekeeper;
use App\Models\User;
use Illuminate\Database\Seeder;

class BeekeeperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(20)->has(Beekeeper::factory())->create();
        User::factory(['email' => 'jon@doe.ch'])->has(Beekeeper::factory(['firstname' => 'Jon', 'lastname' => 'Doe']))->create();
    }
}
