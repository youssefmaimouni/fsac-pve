<?php

namespace Database\Seeders;

use App\Models\Session;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    public function run()
    {
        Session::factory()->count(15)->create(); // Crée 15 sessions
    }
}
