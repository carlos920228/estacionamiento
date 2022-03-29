<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\estacionamiento;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
class estacionamientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
     protected $model = estacionamiento::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->firstname()
        ];
    }
}
