<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tablette;
use App\Models\Local;

class AffectationFactory extends Factory
{
    public function definition()
    {
        $year = $this->faker->numberBetween(2020, 2024); // Ensures the year is between 2020 and 2021
        $month = $this->faker->randomElement([1, 6]); // Only January and June
        $day = $this->faker->numberBetween(5, 15); // Day between 5 and 15 regardless of month

        return [
            'id_tablette' => Tablette::inRandomOrder()->first()->id_tablette ?? null, // Selects a random tablette id or null
            'id_local' => Local::inRandomOrder()->first()->id_local ?? null, // Selects a random local id or null
            'date_affectation' => sprintf('%d-%02d-%02d', $year, $month, $day),
            'demi_journee_affectation' => $this->faker->randomElement(['AM', 'PM']) // 'AM' for morning, 'PM' for afternoon
        ];
    }
}
