@extends('layouts.base')

@section('title', 'Gestión de Permisos')

@section('content')
<div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-4xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Listado de Permisos</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6">
        <a href="{{ route('admin.permisos.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            + Nuevo Permiso
        </a>
    </div>

    <table class="min-w-full border border-gray-300 rounded-lg">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="py-2 px-4">ID</th>
                <th class="py-2 px-4">Nombre</th>
                <th class="py-2 px-4">Descripción</th>
                <th class="py-2 px-4 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($permisos as $permiso)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $permiso->id }}</td>
                    <td class="py-2 px-4 font-semibold text-gray-800">{{ $permiso->nombre }}</td>
                    <td class="py-2 px-4 text-gray-600">{{ $permiso->descripcion ?? '-' }}</td>
                    <td class="py-2 px-4 text-center">
                        <a href="{{ route('admin.permisos.edit', $permiso->id) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded mr-2">Editar</a>

                        <form action="{{ route('admin.permisos.destroy', $permiso->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Eliminar este permiso?')" 
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 py-4">No hay permisos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection