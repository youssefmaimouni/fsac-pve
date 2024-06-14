<?php

namespace Database\Seeders;

use App\Models\Administrateur;
use Illuminate\Database\Seeder;

class AdministrateurSeeder extends Seeder
{
    public function run()
    {
        Administrateur::factory()->count(5)->create(); // Crée 5 administrateurs
    }
}
