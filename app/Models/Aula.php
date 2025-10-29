<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table = 'aulas';
    protected $primaryKey = 'nro';
    public $incrementing = false; // porque 'nro' no es autoincremental
    protected $keyType = 'int';

    protected $fillable = ['nro', 'capacidad', 'piso'];
}