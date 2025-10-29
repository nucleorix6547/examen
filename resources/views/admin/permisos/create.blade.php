@extends('layouts.base')

@section('title', 'Crear Permiso')

@section('content')
<div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-lg">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Nuevo Permiso</h2>

    <form action="{{ route('admin.permisos.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="nombre" class="block font-semibold text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
            @error('nombre') 
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <div class="mb-6">
            <label for="descripcion" class="block font-semibold text-gray-700">Descripción</label>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.permisos.index') }}" 
               class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>

            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection