@extends('layouts.base')

@section('title', 'Editar Aula')

@section('content')
<div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-lg">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Editar Aula N° {{ $aula->nro }}</h2>

    <form action="{{ route('admin.aulas.update', $aula->nro) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-semibold">Capacidad</label>
            <input type="number" name="capacidad" value="{{ $aula->capacidad }}" 
                   class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold">Piso</label>
            <input type="number" name="piso" value="{{ $aula->piso }}" 
                   class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.aulas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Cancelar
            </a>
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                Actualizar
            </button>
        </div>
    </form>
</div>
@endsection