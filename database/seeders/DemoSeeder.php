<?php

namespace Database\Seeders;

use App\Models\Postcode;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kuesnacht = Postcode::where('postcode', 8700)->first();
        $kuesnacht->beekeepers()->detach();

        $erlenbach = Postcode::where('postcode', 8703)->first();
        $erlenbach->beekeepers()->detach();

    }
}
