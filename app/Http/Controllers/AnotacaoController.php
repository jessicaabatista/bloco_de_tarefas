<?php

namespace App\Http\Controllers;

date_default_timezone_set('America/Sao_Paulo');

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnotacaoController extends Controller
{
    public function index(Request $request)
    {
        $anotacoes = null;

        if ($anotacoes == null) {
            $anotacoes = \App\Models\Anotacao::orderBy('AnotacaoID','desc')->simplePaginate(8);
        }
        
        $usuarios = \App\Models\User::all();

        return view('listaAnotacoes'
            , ['anotacoes' => $anotacoes
                , 'usuarios' => $usuarios
            ]
        );
    }

    public function insere(Request $request)
    {
        $dataConclusao = null;
        $Concluido = false;
        $criador = Auth::user()->id;
        $mensagemSucessoAnotacao = 0;

        DB::table('Anotacao')->insert(
            ['Descricao' => $_POST['descricao']
                , 'DataCriacao' => date("Y-m-d H:i:s")
                , 'DataConclusao' => $dataConclusao
                , 'Concluido' => $Concluido
                , 'CriadorAnotacao' => $criador
                , 'UsuarioIDFK' => $_POST['usuario']
            ]
        );

        $mensagemSucessoAnotacao = 1;
        return redirect()->route('listaAnotacoes.index')->with('mensagemSucessoAnotacao', $mensagemSucessoAnotacao);
    }
}
