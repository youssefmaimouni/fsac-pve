<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Administrateur;
use App\Models\Session;

class GererFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Gerer::class;

    /**
     * The storage for used combinations.
     *
     * @var array
     */
    protected static $usedCombinations = [];

    public function definition()
    {
        $administrateurIds = Administrateur::pluck('id_administrateur')->toArray();
        $sessionIds = Session::pluck('id_session')->toArray();

        do {
            $id_administrateur = $this->faker->randomElement($administrateurIds);
            $id_session = $this->faker->randomElement($sessionIds);
            $combination = $id_administrateur . '-' . $id_session;
        } while (in_array($combination, self::$usedCombinations) && count(self::$usedCombinations) < count($administrateurIds) * count($sessionIds));

        self::$usedCombinations[] = $combination;

        return [
            'id_administrateur' => $id_administrateur,
            'id_session' => $id_session,
        ];
    }
}
