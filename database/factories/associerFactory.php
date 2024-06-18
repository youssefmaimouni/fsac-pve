<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Affectation;
use App\Models\Surveillant;

class AssocierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Associer::class;

    /**
     * The storage for used combinations.
     *
     * @var array
     */
    protected static $usedCombinations = [];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $affectationIds = Affectation::pluck('id_affectation')->toArray();
        $surveillantIds = Surveillant::pluck('id_surveillant')->toArray();

        do {
            $id_affectation = $this->faker->randomElement($affectationIds);
            $id_surveillant = $this->faker->randomElement($surveillantIds);
            $combination = $id_affectation . '-' . $id_surveillant;
        } while (in_array($combination, self::$usedCombinations) && count(self::$usedCombinations) < count($affectationIds) * count($surveillantIds));

        self::$usedCombinations[] = $combination;

        return [
            'id_affectation' => $id_affectation,
            'id_surveillant' => $id_surveillant,
        ];
    }

    /**
     * Reset used combinations.
     */
    public static function resetUsedCombinations()
    {
        self::$usedCombinations = [];
    }
}
