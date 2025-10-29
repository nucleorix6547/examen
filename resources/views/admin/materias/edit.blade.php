@extends('layouts.base')

@section('title', 'Editar Materia')

@section('content')
<div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md mx-auto text-center">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Editar Materia</h2>

    <form action="{{ route('admin.materias.update', $materia->sigla) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Sigla (no editable porque es clave primaria) -->
        <div class="mb-4 text-left">
            <label for="sigla" class="block text-gray-700 font-semibold mb-2">Sigla</label>
            <input type="text" id="sigla" name="sigla" value="{{ old('sigla', $materia->sigla) }}"
                   class="w-full border-gray-300 rounded-lg px-3 py-2 bg-gray-100 cursor-not-allowed"
                   readonly>
        </div>

        <!-- Nombre -->
        <div class="mb-4 text-left">
            <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $materia->nombre) }}"
                   class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
            @error('nombre')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Semestre -->
        <div class="mb-4 text-left">
            <label for="semestre" class="block text-gray-700 font-semibold mb-2">Semestre</label>
            <input type="number" id="semestre" name="semestre" value="{{ old('semestre', $materia->semestre) }}"
                   class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                   min="1" max="12" required>
            @error('semestre')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" 
                class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-300">
            Actualizar
        </button>
    </form>

    <div class="mt-6">
        <a href="{{ route('admin.materias.index') }}" class="text-blue-600 hover:underline">
            ← Volver a la lista
        </a>
    </div>
</div>
@endsection