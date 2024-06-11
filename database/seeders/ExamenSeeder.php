<?php

namespace Database\Seeders;

use App\Models\Examen;
use Illuminate\Database\Seeder;

class ExamenSeeder extends Seeder
{
    public function run()
    {
        Examen::factory()->count(50)->create(); // Crée 50 examens
    }
}
