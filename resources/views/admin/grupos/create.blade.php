@extends('layouts.base')

@section('title', 'Crear Grupo')

@section('content')
<div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md mx-auto text-center">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">➕ Crear Nuevo Grupo</h2>

    <form action="{{ route('admin.grupos.store') }}" method="POST">
        @csrf
        <div class="mb-4 text-left">
            <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre del Grupo:</label>
            <input type="text" id="nombre" name="nombre" 
                   class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                   placeholder="Ej: MAT101-SC" required>
            @error('nombre')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-300">
            Guardar Grupo
        </button>
    </form>

    <div class="mt-6">
        <a href="{{ route('admin.grupos.index') }}" class="text-blue-600 hover:underline">
            ← Volver a la lista
        </a>
    </div>
</div>
@endsection