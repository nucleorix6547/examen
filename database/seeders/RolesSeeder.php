<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
class RolesSeeder extends Seeder
{

    public function run()
        {
            Rol::updateOrCreate(
                ['nombre' => 'Administrador'],
                ['descripcion' => 'Usuario con acceso total al sistema']
            );
        }
}