<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\DocenteController;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\GrupoController;
use App\Http\Controllers\Admin\MateriaController;
use App\Http\Controllers\Admin\AsistenciaController;
use App\Http\Controllers\Admin\AulaController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\PermisoController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| RUTAS DE AUTENTICACIÓN
|--------------------------------------------------------------------------
*/


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/password/forgot', [AuthController::class, 'showForgotForm'])->name('password.request');
Route::post('/password/forgot', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update.by.email');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect('/login');
});


/*
|--------------------------------------------------------------------------
| RUTAS DEL PANEL ADMINISTRADOR
|--------------------------------------------------------------------------
|
| Solo accesibles para usuarios autenticados y con rol_id = 1
|
*/
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth');

Route::get('/usuario/definido', function () {
    $usuario = Auth::user();
    return view('usuario.definido', compact('usuario'));
})->name('usuario.definido')->middleware('auth');

Route::get('/usuario/sin-definir', function () {
    return view('usuario.sindefinir');
})->name('usuario.sindefinir')->middleware('auth');
use App\Http\Controllers\BitacoraController;

Route::get('/admin/bitacora', [BitacoraController::class, 'index'])
    ->name('admin.bitacora')
    ->middleware('auth');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('materias', MateriaController::class)->names('admin.materias');
});

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::resource('grupos', GrupoController::class);
});

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::resource('aulas', AulaController::class);
});

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::resource('horario', App\Http\Controllers\Admin\HorarioController::class);
});

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::resource('roles', App\Http\Controllers\Admin\RolController::class)
    ->parameters(['roles' => 'rol']);
}); 
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::resource('permisos', App\Http\Controllers\Admin\PermisoController::class);
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios.index');
    Route::get('/usuarios/{usuario}/contratar', [UsuarioController::class, 'contratar'])->name('admin.usuarios.contratar');
    Route::post('/usuarios/{usuario}/asignar-rol', [UsuarioController::class, 'asignarRol'])->name('admin.usuarios.asignarRol');
});

// Panel general
// 🧑 Panel del usuario autenticado (docente, admin, etc.)
Route::get('/panel', [UsuarioController::class, 'panel'])
    ->name('usuario.panel')
    ->middleware('auth');

// 👑 Sección de administración
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // 📋 Listado de todos los usuarios
    Route::get('/usuarios', [UsuarioController::class, 'gestionarUsuario'])
        ->name('admin.usuarios.index');

    // 🧾 Formulario de contratación de un usuario
    Route::get('/usuarios/{usuario}/contratar', [UsuarioController::class, 'contratar'])
        ->name('admin.usuarios.contratar');

    // 💼 Asignar rol a un usuario
    Route::post('/usuarios/{usuario}/asignar', [UsuarioController::class, 'asignarRol'])
        ->name('admin.usuarios.asignarRol');

    // 🧑‍🏫 Guardar datos del docente (solo admin)
    Route::post('/usuarios/{usuario}/docente', [UsuarioController::class, 'guardarDocenteAdmin'])
        ->name('admin.docente.guardar');
});
// Dashboard (si lo tienes)
//Route::get('/dashboard', function () {
//   return view('dashboard');
//})->name('dashboard');
