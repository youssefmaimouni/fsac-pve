<?php

namespace Database\Factories;

use App\Models\Tablette;
use Illuminate\Database\Eloquent\Factories\Factory;

class TabletteFactory extends Factory
{
    protected $model = Tablette::class;

    public function definition()
    {
        $statut = $this->faker->randomElement(['associer', 'non associer', 'refuser', 'bloquer']);

        return [
            'device_id' => $this->generateDeviceId(),
            'statut' => $statut,
            'code_association' => $statut === 'associer' ? $this->faker->randomNumber() : null,
        ];
    }

    /**
     * Génère un identifiant de device similaire à "SP1A.210812.016.N970U1UES8HWG1"
     */
    public function generateDeviceId()
    {
        return 'SP1A.' . 
               $this->faker->numerify('######') . '.' . 
               $this->faker->numerify('###') . '.' . 
               $this->faker->bothify('N####U1UES###G#');
    }
}
