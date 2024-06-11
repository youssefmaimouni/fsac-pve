<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Examen;
use App\Models\Local;
use App\Models\Etudiant;

class passerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\passer::class;

    /**
     * The storage for used combinations.
     *
     * @var array
     */
    protected static $usedCombinations = [];

    public function definition()
    {
        $examenIds = Examen::pluck('id_examen')->toArray();
        $localIds = Local::pluck('id_local')->toArray();
        $etudiantCodes = Etudiant::pluck('codeApogee')->toArray();

        do {
            $id_examen = $this->faker->randomElement($examenIds);
            $id_local = $this->faker->randomElement($localIds);
            $codeApogee = $this->faker->randomElement($etudiantCodes);
            $combination = $codeApogee . '-' . $id_local . '-' . $id_examen;
        } while (in_array($combination, self::$usedCombinations) && count(self::$usedCombinations) < count($examenIds) * count($localIds) * count($etudiantCodes));

        self::$usedCombinations[] = $combination;

        return [
            'id_examen' => $id_examen,
            'id_local' => $id_local,
            'codeApogee' => $codeApogee,
            'isPresent' => $this->faker->boolean(80), // 80% chance to be present
            'num_exam' => $this->faker->unique()->numberBetween(1, 50) // Generates a unique exam number
        ];
    }
}
