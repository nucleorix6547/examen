@extends('layouts.base')

@section('title', 'Panel de Administrador')

@section('content')
<div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-2xl text-center">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Bienvenido, Administrador</h2>
    <p class="text-gray-600 mb-8">Selecciona una de las siguientes opciones:</p>

    <div class="grid grid-cols-2 gap-6">
        <a href="{{ route('admin.materias.index') }}" 
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 text-center">
            Materias
        </a>

        <a href="{{ route('admin.grupos.index') }}"
            class="bg-green-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 text-center">
            Grupos
        </a>

        <a href="{{ route('admin.aulas.index') }}"
            class="bg-indigo-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 text-center">
            Aulas
        </a>

        <button type="button"
            class="bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-lg transition duration-300 w-full">
            Docentes
        </button>
        
        <a href="{{ route('admin.bitacora') }}" 
            class="bg-yellow-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 text-center ">
            Bitácora
        </a>

        <a href="{{ route('admin.horario.index') }}"
            class="bg-purple-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 text-center">
            Horario
        </a>
    </div>

    <form action="{{ route('logout') }}" method="POST" class="mt-10">
        @csrf
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg">
            Cerrar sesión
        </button>
    </form>
</div>
@endsection