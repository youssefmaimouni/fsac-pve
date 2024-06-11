<?php

namespace Database\Seeders;

use App\Models\Pv;
use Illuminate\Database\Seeder;

class PvSeeder extends Seeder
{
    public function run()
    {
        Pv::factory()->count(20)->create(); // Crée 20 entrées pour `pvs`
    }
}
