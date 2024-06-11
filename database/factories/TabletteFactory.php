<?php

namespace Database\Factories;

use App\Models\Tablette;
use Illuminate\Database\Eloquent\Factories\Factory;

class TabletteFactory extends Factory
{
    protected $model = Tablette::class;

    public function definition()
    {
        return [
            'device_id' => $this->generateDeviceId(),
            'statut' => $this->faker->randomElement(['asocier', 'non asocier','refuser','bloquer']),
            'code_association' => $this->faker->optional()->randomNumber(),
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
