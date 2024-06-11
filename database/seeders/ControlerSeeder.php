<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Controler;

class ControlerSeeder extends Seeder
{
    public function run()
    {
        Controler::factory()->count(20)->create(); // Crée 20 relations entre administrateurs et tablettes
    }
}
