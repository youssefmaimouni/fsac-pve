<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Affectation;

class AffectationSeeder extends Seeder
{
    public function run()
    {
        Affectation::factory()->count(30)->create(); // Creates 30 affectations
    }
}
