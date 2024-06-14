<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gerer;

class GererSeeder extends Seeder
{
    public function run()
    {
        Gerer::factory()->count(20)->create(); // Crée 20 relations entre administrateurs et sessions
    }
}
