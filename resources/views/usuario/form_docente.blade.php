@extends('layouts.base')

@section('title', 'Completar datos Docente')

@section('content')
<div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">🧾 Completar Datos Docente</h2>
    <p class="text-gray-600 mb-6">Completa la siguiente información para continuar.</p>

    <form action="{{ route('admin.docente.guardar', $usuario->registro) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="fecha_contrato" class="block font-semibold text-gray-700">📅 Fecha de Contrato</label>
            <input type="date" name="fecha_contrato" id="fecha_contrato" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label for="especialidad" class="block font-semibold text-gray-700">📘 Especialidad</label>
            <input type="text" name="especialidad" id="especialidad" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label for="sueldo" class="block font-semibold text-gray-700">💰 Sueldo</label>
            <input type="number" step="0.01" name="sueldo" id="sueldo" class="w-full border rounded-lg p-2" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 w-full transition">
            Guardar Datos
        </button>
    </form>
</div>
@endsection