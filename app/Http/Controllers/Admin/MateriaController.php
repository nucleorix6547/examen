<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::all();
        return view('admin.materias.index', compact('materias'));
    }

    public function create()
    {
        return view('admin.materias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sigla' => 'required|string|max:10|unique:materia,sigla',
            'nombre' => 'required|string|max:100',
            'semestre' => 'required|integer|min:1|max:12',
        ]);

        Materia::create($request->all());

        return redirect()->route('admin.materias.index')->with('success', 'Materia creada correctamente');
    }

    public function edit(Materia $materia)
    {
        return view('admin.materias.edit', compact('materia'));
    }

    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'semestre' => 'required|integer|min:1|max:12',
        ]);

        $materia->update($request->only('nombre', 'semestre'));

        return redirect()->route('admin.materias.index')->with('success', 'Materia actualizada correctamente');
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();

        return redirect()->route('admin.materias.index')->with('success', 'Materia eliminada correctamente');
    }
}