<?php

namespace Database\Seeders;

use App\Models\Rapport;
use Illuminate\Database\Seeder;

class RapportSeeder extends Seeder
{
    public function run()
    {
        Rapport::factory()->count(30)->create(); // Crée 30 rapports
    }
}
