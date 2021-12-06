<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function buscaInfos(Request $request)
    {
        $anotacoesUsuario = \App\Models\Anotacao::where('Concluido', false)->orderBy('AnotacaoID','desc')->get();

        return view('home'
            , ['anotacoesUsuario'=>$anotacoesUsuario]
        );
    }
}
