<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('entrada');
            $table->dateTime('salida');
            $table->decimal('total', 8, 2);
            $table->string('placas',40);
            $table->string('descripcion',400);
            $table->decimal('costo', 8, 2);
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
        Schema::dropIfExists('entradas');
    }
}
