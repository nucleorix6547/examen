@extends('layouts.base')

@section('title', 'Iniciar sesión')

@section('content')
<div class="bg-white bg-opacity-90 shadow-2xl rounded-2xl p-10 w-full max-w-md text-center transform transition hover:scale-[1.02]">
    <img src="{{ asset('images/logo.png') }}" alt="Logo Facultad" class="mx-auto mb-6 w-25 h-28 rounded-full shadow-lg border-4 border-blue-500">

    <h2 class="text-3xl font-bold text-blue-700 mb-4">Iniciar sesión</h2>
    <p class="text-gray-500 mb-6 text-sm">Accede a tu cuenta institucional</p>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 font-semibold border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5 text-left">
        @csrf

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Registro o Correo</label>
            <input type="text" name="identificador" placeholder="Ej: 202300123 o usuario@facultad.edu"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Contraseña</label>
            <input type="password" name="contrasena" placeholder="********"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300">
            Ingresar
        </button>
    </form>

    <div class="mt-4 text-sm">
        <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline font-semibold">
            ¿Olvidaste tu contraseña?
        </a>
    </div>

    <p class="mt-6 text-gray-600 text-sm">
        ¿No tienes cuenta?
        <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-semibold">Regístrate aquí</a>
    </p>
</div>
@endsection