<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Docente;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuario = Auth::user()->load('rol.permisos');
        return view('usuario.definido', compact('usuario'));
    }
    public function gestionarUsuario()
    {
        // Solo los administradores deberían entrar aquí
        $usuarios = Usuario::with('rol')->get();
        return view('usuario.index', compact('usuarios'));
    }

    public function contratar(Usuario $usuario)
    {
        $roles = Rol::all();
        return view('usuario.contratar', compact('usuario', 'roles'));
    }

    public function asignarRol(Request $request, Usuario $usuario)
    {
        $request->validate([
            'rol_id' => 'required|exists:roles,id',
        ]);

        $usuario->rol_id = $request->rol_id;
        $usuario->save();

        // Si el usuario es docente, mostrar el formulario al ADMIN
        if ($usuario->rol && $usuario->rol->nombre === 'Docente') {
            return view('usuario.form_docente', compact('usuario'));
        }

        return redirect()->route('admin.usuario.index')->with('success', 'Rol asignado correctamente.');
    }
    public function panel()
    {
        $usuario = Auth::user();

        if (!$usuario->rol) {
            return view('usuario.sindefinir');
        }

        return view('usuario.definido', compact('usuario'));
    }

    public function formDocente()
    {
        $usuario = Auth::user();

        if ($usuario->estado === 'completo') {
            return redirect()->route('usuario.panel')->with('info', 'Ya completaste tus datos.');
        }

        return view('usuario.form_docente', compact('usuario'));
    }

    public function guardarDocente(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'fecha_contrato' => 'required|date',
            'especialidad' => 'required|string|max:100',
            'sueldo' => 'required|numeric|min:0',
        ]);

        \App\Models\Docente::create([
            'registro' => $usuario->registro,
            'fecha_contrato' => $request->fecha_contrato,
            'especialidad' => $request->especialidad,
            'sueldo' => $request->sueldo,
        ]);

        $usuario->update(['estado' => true]);

        return redirect()->route('usuario.definido')
            ->with('success', 'Datos del docente guardados correctamente.');
    }
    public function guardarDocenteAdmin(Request $request, Usuario $usuario)
    {
        $request->validate([
            'fecha_contrato' => 'required|date',
            'especialidad' => 'required|string|max:100',
            'sueldo' => 'required|numeric|min:0',
        ]);

        Docente::create([
            'registro' => $usuario->registro,
            'fecha_contrato' => $request->fecha_contrato,
            'especialidad' => $request->especialidad,
            'sueldo' => $request->sueldo,
        ]);

        $usuario->update(['estado' => true]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Docente contratado y datos registrados correctamente.');
    }
}