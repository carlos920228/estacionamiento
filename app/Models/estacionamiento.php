<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\costos;

class estacionamiento extends Model
{
    use HasFactory,softDeletes;
    protected $fillable = [
    'nombre',
];
public function costos()
    {
        return $this->hasMany(Costos::class);
    }
public function entradas()
        {
            return $this->hasMany(Entradas::class);
        }
}
