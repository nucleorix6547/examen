<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horario'; // nombre exacto de tu tabla
    protected $fillable = [
        'dia',
        'hora_inicio',
        'hora_fin',
    ];
}