<?php

namespace Database\Factories;

use App\Models\Pv;
use App\Models\Tablette;
use Illuminate\Database\Eloquent\Factories\Factory;

class PvFactory extends Factory
{
    protected $model = Pv::class;

    public function definition()
    {
        return [
            'id_tablette' => Tablette::inRandomOrder()->first()->id_tablette ?? null, // Sélectionne un id de tablette existant ou null
        ];
    }
}
