<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(['is_admin' => 1])->count(3)->create();
        User::factory(['is_admin' => 1, 'email' => 'admin@admin.ch'])->create();
    }
}
