<?php

namespace Database\Factories;

use App\Models\Local;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocalFactory extends Factory
{
    protected $model = Local::class;

    public function definition()
    {
        $type_local = $this->faker->randomElement(['Salle', 'Amphi', 'R']);
        if ($type_local === 'R') {
            $num_local = '0';
        } else {
            $num_local_prefix = $type_local === 'Salle' ? 'S' : 'A';
            $num_local = $this->faker->bothify($num_local_prefix . '##');
        }

        return [
            'num_local' => $num_local,  // Generates a room number or sets it to 0
            'type_local' => $type_local,  // Randomly selects a room type
        ];
    }
}
