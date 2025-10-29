@extends('layouts.base')

@section('title', 'Crear Materia')

@section('content')
<div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Registrar Nueva Materia</h2>

    <form action="{{ route('admin.materias.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-left font-semibold mb-1">Sigla</label>
            <input type="text" name="sigla" value="{{ old('sigla') }}" maxlength="10" required
                   class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('sigla')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-left font-semibold mb-1">Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" maxlength="100" required
                   class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('nombre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-left font-semibold mb-1">Semestre</label>
            <input type="number" name="semestre" value="{{ old('semestre') }}" min="1" max="12" required
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('semestre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white w-full py-2 rounded-lg font-semibold transition duration-300">
            Guardar Materia
        </button>
    </form>
</div>
@endsection