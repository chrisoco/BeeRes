<?php

namespace Database\Seeders;

use App\Models\Beekeeper;
use App\Models\Contract;
use Illuminate\Database\Seeder;

class BeekeeperContractSeeder extends Seeder
{
    /**
     * Add random 1-5 applicable contracts to each beekeeper
     * Add all random assigned Contracts to also be applicable
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
