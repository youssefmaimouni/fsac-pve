<?php

namespace Database\Factories;

use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionFactory extends Factory
{
    protected $model = Session::class;

    public function definition()
    {
        return [
            'nom_session' => $this->faker->randomElement(['automne-hiver', 'printemps-été']),
            'type_session' => $this->faker->randomElement(['Normal', 'Rattrapage']),
            'Annee_universitaire' => $this->faker->randomElement(['2022-2023', '2023-2024']),
            'datedebut' => $this->faker->date(),
            'datefin' => $this->faker->date()
        ];
    }
}
