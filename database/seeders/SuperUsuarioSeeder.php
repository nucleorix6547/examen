<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class SuperUsuarioSeeder extends Seeder
{
    public function run()
    {
        Usuario::updateOrCreate(
            ['correo' => 'admin@facultad.edu'],
            [
                'registro' => 1111,
                'nombre' => 'Administrador',
                'contrasena' => Hash::make('1234'),
                'rol_id' => 1,
            ]
        );
    }
}
