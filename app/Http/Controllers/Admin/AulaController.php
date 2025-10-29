<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aula;

class AulaController extends Controller
{
    // Listar aulas
    public function index()
    {
        $aulas = Aula::all();
        return view('admin.aulas.index', compact('aulas'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        return view('admin.aulas.create');
    }

    // Guardar nueva aula
    public function store(Request $request)
    {
        $request->validate([
            'nro' => 'required|integer|unique:aulas,nro',
            'capacidad' => 'required|integer|min:1',
            'piso' => 'required|integer',
        ]);

        Aula::create($request->all());

        return redirect()->route('admin.aulas.index')->with('success', 'Aula creada correctamente.');
    }

    // Mostrar formulario para editar
    public function edit($nro)
    {
        $aula = Aula::findOrFail($nro);
        return view('admin.aulas.edit', compact('aula'));
    }

    // Actualizar aula
    public function update(Request $request, $nro)
    {
        $aula = Aula::findOrFail($nro);

        $request->validate([
            'capacidad' => 'required|integer|min:1',
            'piso' => 'required|integer',
        ]);

        $aula->update($request->all());

        return redirect()->route('admin.aulas.index')->with('success', 'Aula actualizada correctamente.');
    }

    // Eliminar aula
    public function destroy($nro)
    {
        $aula = Aula::findOrFail($nro);
        $aula->delete();

        return redirect()->route('admin.aulas.index')->with('success', 'Aula eliminada correctamente.');
    }
}