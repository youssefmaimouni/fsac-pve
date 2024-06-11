<?php

namespace Database\Seeders;

use App\Models\Etudiant;
use Illuminate\Database\Seeder;

class EtudiantSeeder extends Seeder
{
    public function run()
    {
        Etudiant::factory()->count(50)->create(); // Crée 50 étudiants
    }
}
