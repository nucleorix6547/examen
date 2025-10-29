@extends('layouts.base')

@section('title', 'Gestión de Roles')

@section('content')
<div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-5xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Roles del Sistema</h2>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.roles.create') }}" 
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">
            ➕ Crear Rol
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
        <thead class="bg-blue-100 text-blue-800">
            <tr>
                <th class="py-2 px-4 text-left">#</th>
                <th class="py-2 px-4 text-left">Nombre</th>
                <th class="py-2 px-4 text-left">Descripción</th>
                <th class="py-2 px-4 text-left">Permisos</th>
                <th class="py-2 px-4 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $rol)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $rol->id }}</td>
                    <td class="py-2 px-4 font-semibold text-gray-800">{{ $rol->nombre }}</td>
                    <td class="py-2 px-4 text-gray-600">{{ $rol->descripcion ?? '-' }}</td>
                    <td class="py-2 px-4">
                        @if($rol->permisos->isEmpty())
                            <span class="text-gray-500 italic">Sin permisos asignados</span>
                        @else
                            <ul class="list-disc list-inside">
                                @foreach($rol->permisos as $permiso)
                                    <li class="text-sm text-gray-700">{{ $permiso->nombre }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td class="py-2 px-4 text-center">
                        <a href="{{ route('admin.roles.edit', $rol->id) }}" 
                            class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded-lg font-semibold">
                            ✏️ Editar
                        </a>

                        {{-- Botón de eliminar opcional --}}
                        <form action="{{ route('admin.roles.destroy', $rol->id) }}" 
                              method="POST" class="inline-block" 
                              onsubmit="return confirm('¿Seguro que deseas eliminar este rol?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded-lg font-semibold">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection