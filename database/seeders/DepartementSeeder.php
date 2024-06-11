<?php

namespace Database\Seeders;

use App\Models\Departement;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    public function run()
    {
        Departement::factory()->count(10)->create(); // Crée 10 entrées de départements
    }
}
