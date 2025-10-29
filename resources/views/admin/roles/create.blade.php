@extends('layouts.base')

@section('title', 'Crear Rol')

@section('content')
<div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-3xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Crear Nuevo Rol</h2>

    <form action="{{ route('admin.roles.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Nombre del Rol</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-300">
            @error('nombre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Descripción</label>
            <textarea name="descripcion" rows="3"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-300">{{ old('descripcion') }}</textarea>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Permisos disponibles</label>
            <div class="grid grid-cols-2 gap-3 border rounded-lg p-4 bg-gray-50">
                @foreach($permisos as $permiso)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="permisos[]" value="{{ $permiso->id }}" class="accent-blue-600">
                        <span>{{ $permiso->nombre }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="text-center">
            <button type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg">
                💾 Guardar Rol
            </button>
            <a href="{{ route('admin.roles.index') }}" 
                class="ml-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg">
                🔙 Volver
            </a>
        </div>
    </form>
</div>
@endsection