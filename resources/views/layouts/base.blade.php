<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Facultad')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
</head>

<body class="font-[Poppins] bg-gradient-to-br from-blue-100 via-blue-200 to-blue-300 min-h-screen flex flex-col">

    {{-- Navbar --}}
    <nav class="bg-white bg-opacity-80 backdrop-blur-md shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            {{-- Logo y título --}}
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Facultad" class="w-10 h-15 rounded-full">
                <h1 class="text-xl font-bold text-blue-700">Facultad de Ingeniería</h1>
            </div>

            {{-- Enlaces de navegación --}}
            <div class="space-x-6 text-sm md:text-base">
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-blue-600 font-semibold">
                            Inicio
                        </button>
                    </form>
                @else
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 font-semibold">Inicio</a>
                @endauth
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600 font-semibold">Registrarse</a>

                @auth
                @if(Auth::user()->rol && Auth::user()->rol->nombre === 'Administrador')
                    <div class="relative inline-block text-left">
                        <button id="menuButton" onclick="toggleMenu()" 
                            class="bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            ⚙️ Menú Admin
                        </button>

                        <div id="adminMenu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                            <a href="{{ route('admin.roles.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50">Gestionar Roles</a>
                            <a href="{{ route('admin.permisos.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50">Gestionar Permisos</a>
                            <a href="{{ route('admin.usuarios.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50">Gestionar Usuarios</a>
                        </div>
                    </div>

                    <script>
                        function toggleMenu() {
                            document.getElementById('adminMenu').classList.toggle('hidden');
                        }
                        window.onclick = function(e) {
                            if (!e.target.matches('#menuButton')) {
                                document.getElementById('adminMenu').classList.add('hidden');
                            }
                        }
                    </script>
                    @endif
                @endauth
                
            </div>
        </div>
    </nav>

    {{-- Contenido principal --}}
    <main class="flex-grow flex items-center justify-center p-6 animate-fadeIn">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center text-gray-600 text-sm py-4">
        © {{ date('Y') }} Facultad de Ingeniería — Todos los derechos reservados.
    </footer>

    {{-- Animación básica --}}
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.8s ease-in-out;
        }
    </style>
</body>
</html>