@extends('layouts.base')

@section('title', 'Bitácora del Sistema')

@section('content')
<div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-5xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">📜 Registro de Bitácora</h2>

    @if($bitacoras->isEmpty())
        <p class="text-center text-gray-600">No hay movimientos registrados aún.</p>
    @else
        <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Acción</th>
                    <th>Descripción</th>
                    <th>ip</th> <!-- ✅ -->
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($bitacoras as $b)
            <tr>
                <td>{{ $b->usuario_registro }}</td>
                <td>{{ $b->accion }}</td>
                <td>{{ $b->descripcion }}</td>
                <td>{{ $b->ip ?? 'N/A' }}</td> <!-- ✅ -->
                <td>{{ $b->fecha }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <div class="mt-6 text-center">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline font-semibold">
            ← Volver al Panel
        </a>
    </div>
</div>
@endsection