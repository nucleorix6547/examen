<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grupo;

class GrupoController extends Controller
{
    // Mostrar todos los grupos
    public function index()
    {
        $grupos = Grupo::all();
        return view('admin.grupos.index', compact('grupos'));
    }

    // Mostrar formulario para crear grupo
    public function create()
    {
        return view('admin.grupos.create');
    }

    // Guardar grupo nuevo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:grupo,nombre',
        ]);

        Grupo::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('admin.grupos.index')->with('success', 'Grupo creado correctamente.');
    }

    // Mostrar formulario para editar grupo
    public function edit(Grupo $grupo)
    {
        return view('admin.grupos.edit', compact('grupo'));
    }

    // Actualizar grupo
    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:grupo,nombre,' . $grupo->id,
        ]);

        $grupo->update(['nombre' => $request->nombre]);

        return redirect()->route('admin.grupos.index')->with('success', 'Grupo actualizado correctamente.');
    }

    // Eliminar grupo
    public function destroy(Grupo $grupo)
    {
        $grupo->delete();
        return redirect()->route('admin.grupos.index')->with('success', 'Grupo eliminado correctamente.');
    }
}