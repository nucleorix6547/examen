<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('admin.usuarios.index');
    }
}