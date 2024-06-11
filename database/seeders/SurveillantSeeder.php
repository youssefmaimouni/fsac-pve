<?php

namespace Database\Seeders;

use App\Models\Surveillant;
use Illuminate\Database\Seeder;

class SurveillantSeeder extends Seeder
{
    public function run()
    {
        Surveillant::factory()->count(20)->create(); // Crée 20 surveillants
    }
}
