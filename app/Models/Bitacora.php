<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacora';
    public $timestamps = false; // ya manejas la fecha manualmente

    protected $fillable = [
        'usuario_registro',
        'accion',
        'descripcion',
        'fecha',
        'ip', // 👈 AGREGA ESTO
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_registro', 'registro');
    }
}