<?php

namespace Database\Factories;

use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionFactory extends Factory
{
    protected $model = Session::class;

    public function definition()
    {
        $annee_universitaire = $this->faker->randomElement(['2020-2021', '2021-2022', '2022-2023', '2023-2024']);
        $year = explode('-', $annee_universitaire)[1]; 
        if (rand(0, 1) === 0) {
            $datedebut = $this->faker->dateTimeBetween("$year-05-01", "$year-05-20");
            $datefin = $this->faker->dateTimeBetween("$year-05-01", "$year-05-20");
        } else {
            $datedebut = $this->faker->dateTimeBetween("$year-06-01", "$year-06-20");
            $datefin = $this->faker->dateTimeBetween("$year-06-01", "$year-06-20");
        }

        return [
            'nom_session' => $this->faker->randomElement(['automne-hiver', 'printemps-été']),
            'type_session' => $this->faker->randomElement(['Normal', 'Rattrapage']),
            'Annee_universitaire' => $annee_universitaire,
            'datedebut' => $datedebut->format('Y-m-d'),
            'datefin' => $datefin->format('Y-m-d'),
        ];
    }
}
