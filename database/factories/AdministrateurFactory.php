<?php

namespace Database\Factories;

use App\Models\Administrateur;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdministrateurFactory extends Factory
{
    protected $model = Administrateur::class;

    public function definition()
    {
        return [
            'mail' => $this->faker->unique()->safeEmail(), // Génère une adresse email unique
            'nom' => $this->faker->lastName(), // Génère un nom
            'prenom' => $this->faker->firstName(), // Génère un prénom
            'password' => Hash::make('123456789'), // Hash un mot de passe commun pour tous les utilisateurs générés
        ];
    }
}
