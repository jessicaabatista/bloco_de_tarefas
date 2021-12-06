<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListasController extends Controller
{
    public function index()
    {
        $usuarios = \App\Models\Usuario::where('ativo',1)->get();
        
        return view('cadastroAnotacao', [
            'usuarios' => $usuarios
            ]);
    }
}
