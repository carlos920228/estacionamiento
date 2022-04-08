<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\estacionamientos;
class Entradas extends Model
{
  use HasFactory,softDeletes;
  protected $fillable = [
  'entrada',
  'salida',
  'total',
  'placas',
  'descripcion',
  'costo',
  'estacionamientos_id',
  'tipo'
];
public function tw_corporativo(){
    return $this->belongsTo(estacionamientos::class);
  }
}
