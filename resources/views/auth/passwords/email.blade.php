@extends('layouts.base')

@section('title', 'Restablecer contraseña')

@section('content')
<div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md text-center">
    <img src="{{ asset('images/logo_facultad.png') }}" class="mx-auto mb-4 w-20 h-20 rounded-full">
    <h2 class="text-2xl font-bold mb-4">¿Olvidaste tu contraseña?</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4 text-left">
        @csrf
        <label class="block text-gray-700 font-semibold">Correo institucional</label>
        <input type="email" name="correo" placeholder="tu@facultad.edu" required
            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg">
            Enviar enlace de restablecimiento
        </button>
    </form>

    <p class="mt-4 text-sm text-gray-600">
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Volver a iniciar sesión</a>
    </p>
</div>
@endsection