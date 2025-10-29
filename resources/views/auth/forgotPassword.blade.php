@extends('layouts.base')

@section('title', 'Restablecer contraseña')

@section('content')
<div class="bg-white bg-opacity-90 shadow-2xl rounded-2xl p-10 w-full max-w-md text-center">
    <img src="{{ asset('images/logo.png') }}" alt="logo" class="mx-auto mb-6 w-24 h-24 rounded-full shadow-lg border-4 border-blue-500">

    <h2 class="text-2xl font-bold text-blue-700 mb-3">¿Olvidaste tu contraseña?</h2>
    <p class="text-gray-500 mb-6 text-sm">Ingresa tu correo institucional y te enviaremos un enlace para restablecerla.</p>

    @if(session('status'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 border border-green-300">
            {{ session('status') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5 text-left">
        @csrf
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Correo electrónico</label>
            <input type="email" name="email" placeholder="usuario@facultad.edu"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300">
            Enviar enlace
        </button>
    </form>

    <div class="mt-6 text-sm">
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">
            ← Volver al inicio de sesión
        </a>
    </div>
</div>
@endsection