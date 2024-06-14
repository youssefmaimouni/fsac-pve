<?php

namespace Database\Seeders;

use App\Models\passer;
use Illuminate\Database\Seeder;

class PassersSeeder extends Seeder
{
    public function run()
    {
        passer::factory()->count(100)->create(); // Creates 100 records of exam participation
    }
}
