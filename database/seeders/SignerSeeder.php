<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Signer;

class SignerSeeder extends Seeder
{
    public function run()
    {
        Signer::factory()->count(50)->create(); // Creates 50 relationships between surveillants
    }
}
