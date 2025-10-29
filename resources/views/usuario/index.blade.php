@extends('layouts.base')

@section('title', 'Gestionar Usuarios')

@section('content')
<div class="bg-white shadow-lg rounded-2xl p-6 w-full max-w-5xl">
    <h2 class="text-2xl font-semibold text-blue-700 mb-6">👥 Gestión de Usuarios</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-blue-100 text-left text-blue-800">
                <th class="p-3">Registro</th>
                <th class="p-3">Nombre</th>
                <th class="p-3">Correo</th>
                <th class="p-3">Rol</th>
                <th class="p-3 text-center">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr class="border-b hover:bg-blue-50">
                <td class="p-3">{{ $usuario->registro }}</td>
                <td class="p-3">{{ $usuario->nombre }}</td>
                <td class="p-3">{{ $usuario->correo }}</td>
                <td class="p-3">
                    @if($usuario->rol)
                        <span class="text-green-600 font-semibold">{{ $usuario->rol->nombre }}</span>
                    @else
                        <span class="text-gray-500 italic">Sin rol</span>
                    @endif
                </td>
                <td class="p-3 text-center">
                    @if(!$usuario->rol)
                        <a href="{{ route('admin.usuarios.contratar', $usuario->registro) }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            Contratar
                        </a>
                    @else
                        <span class="text-sm text-gray-500">Asignado</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection