<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Surveillant;
use App\Models\Pv;

class SignerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Signer::class;

    /**
     * The storage for used combinations.
     *
     * @var array
     */
    protected static $usedCombinations = [];

    public function definition()
    {
        $surveillantIds = Surveillant::pluck('id_surveillant')->toArray();
        $pvIds = Pv::pluck('id_pv')->toArray();

        do {
            $id_surveillant = $this->faker->randomElement($surveillantIds);
            $id_pv = $this->faker->randomElement($pvIds);
            $combination = $id_surveillant . '-' . $id_pv;
        } while (in_array($combination, self::$usedCombinations) && count(self::$usedCombinations) < count($surveillantIds) * count($pvIds));

        self::$usedCombinations[] = $combination;

        return [
            'id_surveillant' => $id_surveillant,
            'id_pv' => $id_pv,
            'signer' => $this->faker->boolean(80)  // 80% chance to return true, simulating that most signers do sign
        ];
    }
}
