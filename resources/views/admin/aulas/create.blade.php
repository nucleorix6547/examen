@extends('layouts.base')

@section('title', 'Crear Aula')

@section('content')
<div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-lg">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Registrar Nueva Aula</h2>

    <form action="{{ route('admin.aulas.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700 font-semibold">Número de Aula</label>
            <input type="number" name="nro" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold">Capacidad</label>
            <input type="number" name="capacidad" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold">Piso</label>
            <input type="number" name="piso" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.aulas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Volver
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection