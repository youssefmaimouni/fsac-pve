<?php

namespace Database\Factories;

use App\Models\Module;
use App\Models\Filiere;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    protected $model = Module::class;

    public function definition()
    {
        return [
            'intitule_module' => $this->faker->words(2, true),
            'id_filiere' => Filiere::inRandomOrder()->first()->id_filiere // Assurez-vous qu'il y a des filières dans la base
        ];
    }
}
