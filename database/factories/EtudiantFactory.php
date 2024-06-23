<?php

namespace Database\Factories;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    protected $model = Etudiant::class;

    public function definition()
    {
        // Randomly choose between 'men' or 'women' for the image category
        $gender = $this->faker->randomElement(['men', 'women']);
        
        // Randomly choose a number between 1 and 99
        $imageNumber = $this->faker->numberBetween(1, 99);

        return [
            'codeApogee' => $this->faker->unique()->numberBetween(100000, 999999),
            'nom_etudiant' => $this->faker->lastName(),
            'prenom_etudiant' => $this->faker->firstName(),
            'CNE' => $this->faker->bothify('??######'),
            // Construct the URL using the chosen gender and image number
            'photo' => "https://randomuser.me/api/portraits/{$gender}/{$imageNumber}.jpg"
        ];
    }
}
