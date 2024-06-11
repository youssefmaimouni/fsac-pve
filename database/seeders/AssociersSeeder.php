<?php

namespace Database\Seeders;

use App\Models\associer;
use Illuminate\Database\Seeder;

class AssociersSeeder extends Seeder
{
    public function run()
    {
        associer::factory()->count(50)->create(); // Creates 50 associations between affectations and surveillants
    }
}
