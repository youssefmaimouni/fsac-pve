<?php

namespace Database\Factories;

use App\Models\Rapport;
use App\Models\Etudiant;
use App\Models\Pv;
use Illuminate\Database\Eloquent\Factories\Factory;

class RapportFactory extends Factory
{
    protected $model = Rapport::class;

    public function definition()
    {
        return [
            'codeApogee' => Etudiant::inRandomOrder()->first()->codeApogee ?? null, // Assurez-vous qu'il y a des étudiants dans la base
            'titre_rapport' => $this->faker->text(20),
            'contenu' => $this->faker->paragraphs(3, true),
            'id_pv' => Pv::inRandomOrder()->first()->id_pv ?? null // Assurez-vous qu'il y a des PVs dans la base
        ];
    }
}
