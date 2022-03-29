<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Costos;
use App\Models\estacionamiento;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
class CostosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
        protected $model = Costos::class;
    public function definition()
    {
        return [
              'tipoVehiculo' => $this->faker->firstname(),
              'precio'=>$this->faker->randomFloat(2,1,20),
              'estacionamientos_id'=> estacionamiento::pluck('id')->random()
        ];
    }
}
