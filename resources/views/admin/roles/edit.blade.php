@extends('layouts.base')

@section('title', 'Editar Rol')

@section('content')
<div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-lg">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Editar Rol</h2>

    <form action="{{ route('admin.roles.update', $rol) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div class="mb-4">
            <label for="nombre" class="block font-semibold text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $rol->nombre) }}"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
            @error('nombre') 
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Permisos -->
        <div class="mb-6">
            <label class="block font-semibold text-gray-700 mb-2">Permisos asignados</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach($permisos as $permiso)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="permisos[]" value="{{ $permiso->id }}"
                            {{ in_array($permiso->id, $rol->permisos->pluck('id')->toArray()) ? 'checked' : '' }}
                            class="rounded text-blue-600 focus:ring-blue-500">
                        <span class="text-gray-700">{{ $permiso->nombre }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Botones -->
        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.roles.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold">
               Cancelar
            </a>

            <button type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold">
                💾 Actualizar
            </button>
        </div>
    </form>
</div>
@endsection