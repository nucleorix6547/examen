@extends('layouts.base')

@section('title', 'Contratar Usuario')

@section('content')
<div class="bg-white shadow-lg rounded-2xl p-6 w-full max-w-md">
    <h2 class="text-2xl font-semibold text-blue-700 mb-4">🧾 Contratar Usuario</h2>

    <p class="mb-3 text-gray-700">
        Asignar un rol a: <strong>{{ $usuario->nombre }}</strong> ({{ $usuario->correo }})
    </p>

    <form action="{{ route('admin.usuarios.asignarRol', $usuario->registro) }}" method="POST">
        @csrf

        <label for="rol_id" class="block mb-2 font-medium text-gray-700">Seleccionar Rol</label>
        <select name="rol_id" id="rol_id" class="w-full border rounded-lg p-2 mb-4">
            <option value="">-- Selecciona un rol --</option>
            @foreach($roles as $rol)
                <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
            @endforeach
        </select>

        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition w-full">
            Asignar Rol
        </button>
    </form>
</div>
@endsection