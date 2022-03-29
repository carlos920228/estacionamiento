<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Costos;
use App\Models\estacionamiento;
use App\Models\Entradas;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
class EntradasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
     protected $model = Entradas::class;
 public function definition()
 {
   $estacionamiento=estacionamiento::pluck('id')->random();
     return [

           'entrada' => $this->faker->dateTime(),
           'salida'=>$this->faker->dateTime(),
           'total'=>$this->faker->randomFloat(2,0,200),
           'placas'=>Str::random(6),
           'descripcion'=>"Vehículo color: ".$this->faker->colorName(),
           'costo'=>Costos::pluck('precio')->random(),
           'estacionamientos_id'=> $estacionamiento
     ];
 }
}
