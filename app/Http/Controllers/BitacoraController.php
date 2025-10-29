<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;

class BitacoraController extends Controller
{
    public function index()
    {
        // Trae todas las entradas de bitácora ordenadas de más recientes a más antiguas
        $bitacoras = Bitacora::orderBy('fecha', 'desc')->get();

        return view('admin.bitacora', compact('bitacoras'));
    }
}