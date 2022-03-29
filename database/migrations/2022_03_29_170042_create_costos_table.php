<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costos', function (Blueprint $table) {
            $table->id();
            $table->string('tipoVehiculo',200);
            $table->decimal('precio', 8, 2);
            $table->unsignedBigInteger('estacionamientos_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('estacionamientos_id')->references('id')->on('estacionamientos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('costos');
    }
}
