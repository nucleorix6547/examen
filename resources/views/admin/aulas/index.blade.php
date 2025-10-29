@extends('layouts.base')

@section('title', 'Aulas')

@section('content')
<div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-4xl">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Listado de Aulas</h2>

    <a href="{{ route('admin.aulas.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mb-4 inline-block">
        + Nueva Aula
    </a>

    @if(session('success'))
        <p class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</p>
    @endif

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr class="text-center">
                <th class="border p-2">N° Aula</th>
                <th class="border p-2">Capacidad</th>
                <th class="border p-2">Piso</th>
                <th class="border p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aulas as $aula)
            <tr class="text-center">
                <td class="border p-2">{{ $aula->nro }}</td>
                <td class="border p-2">{{ $aula->capacidad }}</td>
                <td class="border p-2">{{ $aula->piso }}</td>
                <td class="border p-2">
                    <a href="{{ route('admin.aulas.edit', $aula->nro) }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Editar</a>
                    <form action="{{ route('admin.aulas.destroy', $aula->nro) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded"
                                onclick="return confirm('¿Eliminar aula?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection