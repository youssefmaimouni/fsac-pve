<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Departement;

class DepartementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Departement::class;

    public function definition()
    {
        // Generate a unique department name
        $nom_departement = $this->faker->unique()->words(2, true);

        // Generate the department code from the first letters of each word in the department name
        $code_departement = $this->generateCodeFromName($nom_departement);

        return [
            'nom_departement' => $nom_departement,
            'code_departement' => $code_departement,
        ];
    }

    /**
     * Generate a code from the first letters of each word in the given name.
     *
     * @param string $name
     * @return string
     */
    private function generateCodeFromName($name)
    {
        // Split the name into words
        $words = explode(' ', $name);

        // Extract the first letter of each word and concatenate them
        $code = '';
        foreach ($words as $word) {
            $code .= strtoupper($word[0]);
        }

        return $code;
    }
}
