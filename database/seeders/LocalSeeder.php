<?php

namespace Database\Seeders;

use App\Models\Local;
use Illuminate\Database\Seeder;

class LocalSeeder extends Seeder
{
    public function run()
    {
        Local::factory()->count(20)->create(); // Crée 20 entrées de locaux
    }
}
