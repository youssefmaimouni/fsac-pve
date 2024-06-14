<?php

namespace Database\Seeders;

use App\Models\Tablette;
use Illuminate\Database\Seeder;

class TabletteSeeder extends Seeder
{
    public function run()
    {
        Tablette::factory()->count(50)->create(); // Crée 50 entrées
    }
}
