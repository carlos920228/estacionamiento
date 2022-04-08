<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      \App\Models\estacionamiento::factory(5)->create();
        \App\Models\Costos::factory(5)->create();
        \App\Models\Entradas::factory(20)->create();
         \App\Models\Team::factory(1)->create();
    }
}
