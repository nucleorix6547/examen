@extends('layouts.base')

@section('title', 'Panel de Usuario')

@section('content')
<div class="bg-white shadow-lg rounded-2xl p-6 w-full max-w-3xl text-center">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">
        Bienvenido, {{ $usuario->nombre }}
    </h2>
    <p class="text-gray-600 mb-6">Rol: <strong>{{ $usuario->rol->nombre }}</strong></p>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 justify-center">
        @foreach($usuario->rol->permisos as $permiso)
            @php
                // Asocia cada permiso con su icono, color y destino
                $config = [
                    'ver_materias' => ['📘', 'bg-blue-600', '/materias', 'Ver Materias'],
                    'ver_horarios' => ['🕒', 'bg-green-600', '/horarios', 'Ver Horarios'],
                    'ver_grupos' => ['👥', 'bg-purple-600', '/grupos', 'Ver Grupos'],
                    'gestionar_asistencias' => ['⚙️', 'bg-red-600', '/admin/asistencias', 'Gestionar Asistencias'],
                ];
            @endphp

            @if(isset($config[$permiso->nombre]))
                @php [$icon, $color, $ruta, $texto] = $config[$permiso->nombre]; @endphp
                <a href="{{ url($ruta) }}" 
                class="{{ $color }} text-white p-3 rounded-xl hover:opacity-90 transition font-medium">
                    {{ $icon }} {{ $texto }}
                </a>
            @endif
        @endforeach
    </div>

    <p class="text-gray-500 mt-8">Solo ves las opciones según tus permisos asignados.</p>
</div>
@endsection