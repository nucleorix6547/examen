<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Bitacora;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        // ✅ Obtenemos todos los roles disponibles para el select
        $roles = Rol::all();
        return view('auth.register', compact('roles'));
    }

    public function register(Request $request)
    {
        // ✅ Validar los campos antes de registrar
        $request->validate([
            'registro' => 'required|numeric|unique:usuarios,registro',
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo',
            'contrasena' => 'required|min:6|confirmed',
        ], [
            'contrasena.confirmed' => 'Las contraseñas no coinciden.',
            'correo.unique' => 'El correo ya está registrado.',
            'registro.unique' => 'El número de registro ya existe.',
        ]);

        // ✅ Crear usuario si pasa la validación
        Usuario::create([
            'registro' => $request->registro,
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
            'rol_id' => null, // por defecto
        ]);

        registrarBitacora($request, 'Registrado', $request, 'Registro exitoso');

        return redirect('/login')->with('success', 'Cuenta creada correctamente.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identificador' => 'required',
            'contrasena' => 'required',
        ]);

        // Buscar usuario por correo o registro
        $usuario = Usuario::where('correo', $request->identificador)
                ->orWhere('registro', $request->identificador)
                ->first();

        if (!$usuario) {
            // No existe la cuenta: redirigir con mensaje (NO 404)
            return redirect()->route('login')->with('error', 'Usuario no encontrado. Por favor regístrate.');
        }
        
        $credenciales = [
            'correo' => $usuario->correo,
            'password' => $request->contrasena,
        ];

        // Intentar login usando Auth::attempt (mapea a getAuthPassword() en el modelo)
        if (Auth::attempt($credenciales)) {
            // Registrar bitacora
            if (function_exists('registrarBitacora')) {
                registrarBitacora($usuario, 'Inicio Sesión', $request, 'Inicio de sesión exitoso');
            }

            // Redirigir por rol
            if ($usuario->rol_id == 1) {
                return redirect()->route('admin.dashboard');
            } elseif (is_null($usuario->rol_id)) {
                return redirect()->route('usuario.sindefinir');
            } else {
                return redirect()->route('usuario.panel');
            }
        }

        // Credenciales incorrectas
        return back()->with('error', 'Correo/Registro o contraseña incorrectos.');
    }

    

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function showForgotForm()
    {
        return view('auth.passwords.email'); // lo creamos abajo
    }

    // Enviar link de restablecimiento
    public function sendResetLink(Request $request)
    {
        $request->validate(['correo' => 'required|email']);

        $user = Usuario::where('correo', $request->correo)->first();

        if (!$user) {
            // No existe usuario con ese correo — no 404, mensaje amigable
            return back()->with('error', 'Usuario no encontrado con ese correo.');
        }

        // Generar token seguro
        $token = Str::random(64);

        // Guardar token (hasheado) en password_resets
        DB::table('password_resets')->updateOrInsert(
            ['correo' => $user->correo],
            [
                'correo' => $user->correo,
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        // Enviar email con link (se incluye el token en claro en la URL)
        $link = url('/password/reset/' . $token . '?correo=' . urlencode($user->correo));
        Mail::to($user->correo)->send(new ResetPasswordMail($user, $link));

        return back()->with('success', 'Se ha enviado un enlace para restablecer la contraseña a tu correo si existe.');
    }

    // Mostrar formulario donde el usuario coloca la nueva contraseña (llega desde email)
    public function showResetForm($token, Request $request)
    {
        $correo = $request->query('correo');
        if (!$correo) {
            return redirect()->route('password.request')->with('error', 'Enlace inválido: falta correo.');
        }
        return view('auth.passwords.reset', ['token' => $token, 'correo' => $correo]);
    }

    // Procesar el restablecimiento (user no necesita estar autenticado)
    public function resetPassword(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'token' => 'required',
            'nueva_contrasena' => 'required|min:6|confirmed',
        ]);

        $record = DB::table('password_resets')->where('correo', $request->correo)->first();

        if (!$record) {
            return back()->with('error', 'Token inválido o expirado. Solicita uno nuevo.');
        }

        // Verificar token (comparamos el token plano recibido con el hasheado)
        if (!Hash::check($request->token, $record->token)) {
            return back()->with('error', 'Token inválido. Solicita un nuevo enlace.');
        }

        // Opcional: comprobar expiración (ej. 60 minutos)
        $created = \Carbon\Carbon::parse($record->created_at);
        if ($created->diffInMinutes(now()) > 60) {
            // borrar el registro
            DB::table('password_resets')->where('correo', $request->correo)->delete();
            return back()->with('error', 'El enlace ha expirado. Solicita uno nuevo.');
        }

        // Actualizar contraseña en tabla usuarios (campo 'contrasena')
        $user = Usuario::where('correo', $request->correo)->first();
        if (!$user) {
            return back()->with('error', 'Usuario no encontrado.');
        }

        $user->contrasena = Hash::make($request->nueva_contrasena);
        $user->save();

        // Eliminar token de la tabla
        DB::table('password_resets')->where('correo', $request->correo)->delete();

        // Opcional: registrar en bitácora
        if (function_exists('registrarBitacora')) {
            registrarBitacora($user, 'Restablecer contraseña', request()->ip() ?? 'IP desconocida', 'Restableció su contraseña por email');
        }

        return redirect()->route('login')->with('success', 'Contraseña restablecida correctamente. Ahora puedes iniciar sesión.');
    }
}