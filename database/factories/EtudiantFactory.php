<?php

namespace Database\Factories;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    protected $model = Etudiant::class;

    public function definition()
    {
        return [
            'codeApogee' => $this->faker->unique()->numberBetween(100000, 999999),
            'nom_etudiant' => $this->faker->lastName(),
            'prenom_etudiant' => $this->faker->firstName(),
            'CNE' => $this->faker->bothify('??######'),
            'photo' => $this->faker->optional()->lexify('https://imgur.com/??????')
        ];
    }
}
