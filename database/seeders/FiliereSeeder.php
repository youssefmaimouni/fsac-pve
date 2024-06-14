<?php

namespace Database\Seeders;

use App\Models\Filiere;
use Illuminate\Database\Seeder;

class FiliereSeeder extends Seeder
{
    public function run()
    {
        Filiere::factory()->count(10)->create(); // Crée 10 entrées de filières
    }
}
