<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Administrateur;
use App\Models\Tablette;

class ControlerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Controler::class;

    /**
     * The storage for used combinations.
     *
     * @var array
     */
    protected static $usedCombinations = [];

    public function definition()
    {
        $administrateurIds = Administrateur::pluck('id_administrateur')->toArray();
        $tabletteIds = Tablette::pluck('id_tablette')->toArray();

        do {
            $id_administrateur = $this->faker->randomElement($administrateurIds);
            $id_tablette = $this->faker->randomElement($tabletteIds);
            $combination = $id_administrateur . '-' . $id_tablette;
        } while (in_array($combination, self::$usedCombinations) && count(self::$usedCombinations) < count($administrateurIds) * count($tabletteIds));

        self::$usedCombinations[] = $combination;

        return [
            'id_administrateur' => $id_administrateur,
            'id_tablette' => $id_tablette,
        ];
    }
}
