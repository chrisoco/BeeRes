<?php

namespace Database\Seeders;

use App\Models\Beekeeper;
use App\Models\Contract;
use Illuminate\Database\Seeder;

class BeekeeperContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Beekeeper::all() as $beekeeper) {

            $j = rand(1, 5);

            for($i = 0; $i < $j; $i++) {
                $beekeeper->contracts_applicable()->attach(Contract::all()->random());
            }

            $beekeeper->contracts_applicable()->attach($beekeeper->contracts);

        }
    }
}
