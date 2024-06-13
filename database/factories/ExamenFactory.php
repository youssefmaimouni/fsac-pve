<?php

namespace Database\Factories;

use App\Models\Examen;
use App\Models\Session;
use App\Models\Module;
use App\Models\Pv;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamenFactory extends Factory
{
    protected $model = Examen::class;

    public function definition()
    {
        $year = $this->faker->numberBetween(2020, 2024);
        $month = $this->faker->randomElement([1, 6]); // Only January and June
        $day = $month === 1 ? $this->faker->numberBetween(5, 15) : $this->faker->numberBetween(5, 15);
        return [
            'id_session' => Session::inRandomOrder()->first()->id_session ?? null, // Assurez-vous qu'il y a des sessions dans la base
            'code_module' => Module::inRandomOrder()->first()->code_module ?? null, // Assurez-vous qu'il y a des modules dans la base
            'id_pv' => Pv::inRandomOrder()->first()->id_pv ?? null, // Assurez-vous qu'il y a des PVs dans la base
            'date_examen' => sprintf('%d-%02d-%02d', $year, $month, $day),
            'demi_journee_examen' => $this->faker->randomElement(['AM', 'PM']),
            'seance_examen' => $this->faker->randomElement(['S1', 'S2', 'S3','S4'])
        ];
    }
}
