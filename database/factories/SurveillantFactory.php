<?php

namespace Database\Factories;

use App\Models\Surveillant;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Factories\Factory;

class SurveillantFactory extends Factory
{
    protected $model = Surveillant::class;

    public function definition()
    {
        return [
            'id_departement' => Departement::inRandomOrder()->first()->id_departement ?? null, // Assurez-vous qu'il y a des départements dans la base
            'nomComplet_s' => $this->faker->name(), // Génère un nom complet
        ];
    }
}
