@extends('layouts.base')

@section('title', 'Iniciar sesión')

@section('content')
<div class="bg-white bg-opacity-90 shadow-2xl rounded-2xl p-10 w-full max-w-md text-center transform transition hover:scale-[1.02]">
    <img src="{{ asset('images/logo.png') }}" alt="Logo Facultad" class="mx-auto mb-6 w-24 h-24 rounded-full shadow-lg border-4 border-blue-500">

    <h2 class="text-3xl font-bold text-blue-700 mb-4">Registrate</h2>
    <p class="text-gray-500 mb-6 text-sm">Accede a tu cuenta institucional</p>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 font-semibold border border-red-300">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 font-semibold border border-red-300 text-left">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label>Registro</label>
                <input type="number" name="registro" class="border w-full p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label>Nombre Completo</label>
                <input type="text" name="nombre" class="border w-full p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label>Correo</label>
                <input type="email" name="correo" class="border w-full p-2 rounded" required>
            </div>



            <div class="mb-4">
                <label>Contraseña</label>
                <input type="password" name="contrasena" class="border w-full p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label>Confirmar Contraseña</label>
                <input type="password" name="contrasena_confirmation" class="border w-full p-2 rounded" required>
            </div>

            <button type="submit" class="bg-green-500 text-white w-full py-2 rounded hover:bg-green-600">
                Registrarse
            </button>
        </form>

@endsection