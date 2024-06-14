<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tablette;
use App\Models\Local;

class AffectationFactory extends Factory
{
    public function definition()
    {
        return [
            'id_tablette' => Tablette::inRandomOrder()->first()->id_tablette ?? null, // Selects a random tablette id or null
            'id_local' => Local::inRandomOrder()->first()->id_local ?? null, // Selects a random local id or null
            'date_affectation' => $this->faker->date($format = 'Y-m-d', $max = '2024-12-31', $min = '2020-01-01'),
            'demi_journee_affectation' => $this->faker->randomElement(['AM', 'PM']) // 'AM' for morning, 'PM' for afternoon
        ];
    }
}
