<?php

namespace Database\Factories;

use App\Models\Local;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocalFactory extends Factory
{
    protected $model = Local::class;

    public function definition()
    {
        return [
            'num_local' => $this->faker->bothify('L##-###'),  // Génère un numéro de local aléatoire, e.g., L12-345
            'type_local' => $this->faker->randomElement(['Salle de classe', 'Laboratoire', 'Bureau']),  // Sélectionne un type de local aléatoirement
        ];
    }
}
