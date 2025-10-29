@extends('layouts.base')

@section('title', 'Gestión de Horarios')

@section('content')
<div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-4xl">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Listado de Horarios</h2>

    <a href="{{ route('admin.horario.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mb-4 inline-block">
        + Nuevo Horario
    </a>

    @if(session('success'))
        <p class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</p>
    @endif

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr class="text-center">
                <th class="p-2">Día</th>
                <th class="p-2">Hora Inicio</th>
                <th class="p-2">Hora Fin</th>
                <th class="p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($horarios as $horario)
            <tr class="text-center border-t">
                <td class="p-2">{{ $horario->dia }}</td>
                <td class="p-2">{{ $horario->hora_inicio }}</td>
                <td class="p-2">{{ $horario->hora_fin }}</td>
                <td class="p-2">
                    <a href="{{ route('admin.horario.edit', $horario->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Editar</a>
                    <form action="{{ route('admin.horario.destroy', $horario->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded" onclick="return confirm('¿Eliminar horario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection