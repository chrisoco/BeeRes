<?php

namespace Database\Seeders;

use App\Models\Beekeeper;
use App\Models\Postcode;
use Illuminate\Database\Seeder;

class BeekeeperPostcodeSeeder extends Seeder
{
    /**
     * Add random 1-5 jurisdictions to each beekeeper
     *
     * @return void
     */
    public function run()
    {
        foreach (Beekeeper::all() as $beekeeper) {

            $j = rand(1, 5);

            for($i = 0; $i < $j; $i++) {
                $beekeeper->postcodes()->attach(Postcode::all()->random());
            }

        }
    }
}
