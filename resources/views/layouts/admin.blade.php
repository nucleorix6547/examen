<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white min-h-screen">
        <div class="p-4 text-center font-bold text-lg border-b border-gray-700">
            Panel Admin
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block p-2 hover:bg-gray-700 rounded">🏠 Inicio</a>
            <a href="{{ route('admin.usuarios') }}" class="block p-2 hover:bg-gray-700 rounded">👥 Usuarios</a>
            <a href="{{ route('admin.docentes') }}" class="block p-2 hover:bg-gray-700 rounded">🎓 Docentes</a>
            <a href="{{ route('admin.horarios') }}" class="block p-2 hover:bg-gray-700 rounded">🕒 Horarios</a>
            <a href="{{ route('admin.grupos') }}" class="block p-2 hover:bg-gray-700 rounded">🏫 Grupos</a>
            <a href="{{ route('admin.materias') }}" class="block p-2 hover:bg-gray-700 rounded">📚 Materias</a>
            <a href="{{ route('admin.asistencias') }}" class="block p-2 hover:bg-gray-700 rounded">📝 Asistencias</a>
        </nav>
    </aside>

    <!-- Contenido -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</body>
</html>