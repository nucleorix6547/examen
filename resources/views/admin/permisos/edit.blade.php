@extends('layouts.base')

@section('title', 'Editar Permiso')

@section('content')
<div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-3xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Editar Permiso</h2>

    <form action="{{ route('admin.permisos.update', $permiso->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div>
            <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre del Permiso</label>
            <input type="text" name="nombre" id="nombre"
                   value="{{ old('nombre', $permiso->nombre) }}" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-300">
            @error('nombre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Botones --}}
        <div class="text-center">
            <button type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg">
                💾 Actualizar Permiso
            </button>
            <a href="{{ route('admin.permisos.index') }}" 
                class="ml-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg">
                🔙 Volver
            </a>
        </div>
    </form>
</div>
@endsection