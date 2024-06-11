<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call other seeders here
        $this->call([
            TabletteSeeder::class,
            FiliereSeeder::class,
            ModuleSeeder::class,
            SessionSeeder::class,
            PvSeeder::class,
            EtudiantSeeder::class,
            RapportSeeder::class,
            LocalSeeder::class,
            ExamenSeeder::class,
            DepartementSeeder::class,
            SurveillantSeeder::class,
            AdministrateurSeeder::class,
            GererSeeder::class,
            ControlerSeeder::class,
            SignerSeeder::class,
            AffectationSeeder::class,
            AssociersSeeder::class,
            PassersSeeder::class,
        ]);
    }
}
