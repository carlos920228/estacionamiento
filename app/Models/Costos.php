<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\estacionamientos;

class Costos extends Model
{
    use HasFactory,softDeletes;
    protected $fillable = [
    'tipoVehiculo',
    'precio',
    'estacionamientos_id'
];
public function tw_corporativo(){
    return $this->belongsTo(estacionamientos::class);
  }
}
