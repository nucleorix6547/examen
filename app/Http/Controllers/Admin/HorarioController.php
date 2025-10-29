<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::all();
        return view('admin.horario.index', compact('horarios'));
    }

    public function create()
    {
        return view('admin.horario.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dia' => 'required|string|max:20',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);

        Horario::create($request->all());

        return redirect()->route('admin.horario.index')->with('success', 'Horario registrado correctamente.');
    }

    public function edit(Horario $horario)
    {
        return view('admin.horario.edit', compact('horario'));
    }

    public function update(Request $request, Horario $horario)
    {
        $request->validate([
            'dia' => 'required|string|max:20',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);

        $horario->update($request->all());

        return redirect()->route('admin.horario.index')->with('success', 'Horario actualizado correctamente.');
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();
        return redirect()->route('admin.horario.index')->with('success', 'Horario eliminado correctamente.');
    }
}