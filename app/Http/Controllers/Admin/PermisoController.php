<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public function index()
    {
        $permisos = Permiso::all();
        return view('admin.permisos.index', compact('permisos'));
    }

    public function create()
    {
        return view('admin.permisos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:permisos,nombre|max:100',
        ]);

        Permiso::create($request->only('nombre'));

        return redirect()->route('admin.permisos.index')->with('success', 'Permiso creado correctamente.');
    }

    public function edit(Permiso $permiso)
    {
        return view('admin.permisos.edit', compact('permiso'));
    }

    public function update(Request $request, Permiso $permiso)
    {
        $request->validate([
            'nombre' => 'required|max:100|unique:permisos,nombre,' . $permiso->id,
        ]);

        $permiso->update($request->only('nombre'));

        return redirect()->route('admin.permisos.index')->with('success', 'Permiso actualizado correctamente.');
    }

    public function destroy(Permiso $permiso)
    {
        $permiso->delete();
        return redirect()->route('admin.permisos.index')->with('success', 'Permiso eliminado correctamente.');
    }
}