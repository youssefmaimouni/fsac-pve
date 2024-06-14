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
     * Storage for tracking unique numbers per exam during a factory run.
     *
     * @var array
     */
    protected static $uniqueNumbersPerExam = [];

    public function definition()
    {
        $examenIds = Examen::pluck('id_examen')->toArray();
        $localIds = Local::pluck('id_local')->toArray();
        $etudiantCodes = Etudiant::pluck('codeApogee')->toArray();

        $id_examen = $this->faker->randomElement($examenIds);
        $num_exam = $this->generateUniqueExamNumberForExam($id_examen);

        return [
            'id_examen' => $id_examen,
            'id_local' => $this->faker->randomElement($localIds),
            'codeApogee' => $this->faker->randomElement($etudiantCodes),
            'isPresent' => $this->faker->boolean(80), // 80% chance to be present
            'num_exam' => $num_exam
        ];
    }

    /**
     * Generate a unique exam number for each exam within the factory run.
     *
     * @param int $id_examen
     * @return int
     */
    protected function generateUniqueExamNumberForExam($id_examen)
    {
        if (!isset(self::$uniqueNumbersPerExam[$id_examen])) {
            self::$uniqueNumbersPerExam[$id_examen] = [];
        }

        do {
            $num_exam = $this->faker->numberBetween(1, 100);
        } while (in_array($num_exam, self::$uniqueNumbersPerExam[$id_examen]));

        self::$uniqueNumbersPerExam[$id_examen][] = $num_exam;

        return $num_exam;
    }
}
