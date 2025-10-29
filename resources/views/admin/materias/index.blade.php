@extends('layouts.base')

@section('title', 'Materias')

@section('content')
<div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-4xl">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Listado de Materias</h2>

    <a href="{{ route('admin.materias.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mb-4 inline-block">
        + Nueva Materia
    </a>

    @if(session('success'))
        <p class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</p>
    @endif

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Sigla</th>
                <th class="border p-2">Nombre</th>
                <th class="border p-2">Semestre</th>
                <th class="border p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materias as $materia)
            <tr class="text-center">
                <td class="border p-2">{{ $materia->sigla }}</td>
                <td class="border p-2">{{ $materia->nombre }}</td>
                <td class="border p-2">{{ $materia->semestre }}</td>
                <td class="border p-2">
                    <a href="{{ route('admin.materias.edit', $materia->sigla) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Editar</a>
                    <form action="{{ route('admin.materias.destroy', $materia->sigla) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded" onclick="return confirm('¿Eliminar materia?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection