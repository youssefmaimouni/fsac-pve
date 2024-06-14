<?php

namespace Database\Factories;

use App\Models\Filiere;
use Illuminate\Database\Eloquent\Factories\Factory;

class FiliereFactory extends Factory
{
    protected $model = Filiere::class;

    public function definition()
    {
        return [
            'nom_filiere' => $this->faker->unique()->words(3, true) // Génère un nom unique de 3 mots
        ];
    }
}
