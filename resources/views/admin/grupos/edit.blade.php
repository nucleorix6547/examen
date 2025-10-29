@extends('layouts.base')

@section('title', 'Editar Grupo')

@section('content')
<div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md mx-auto text-center">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Editar Grupo</h2>

    <form action="{{ route('admin.grupos.update', $grupo) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4 text-left">
            <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre del Grupo:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $grupo->nombre) }}"
                   class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
            @error('nombre')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" 
                class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-300">
            Actualizar
        </button>
    </form>

    <div class="mt-6">
        <a href="{{ route('admin.grupos.index') }}" class="text-blue-600 hover:underline">
            ← Volver a la lista
        </a>
    </div>
</div>
@endsection