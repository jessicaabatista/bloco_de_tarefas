<?php

namespace App\Http\Controllers;

date_default_timezone_set('America/Sao_Paulo');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class anotacaoSelecionada extends Controller
{
    public function index($id, Request $request)
    {
        
        if (isset($id)) {
            
            $usuario = Auth::id();
            $anotacaoAtualizada = \App\Models\Anotacao::where('AnotacaoID', $id)->first();
    
            if (Auth::id() == $anotacaoAtualizada->UsuarioIDFK) {
                $idCorrespondente = true;
            } else {
                $idCorrespondente = false;
            }

            return view(
                'anotacaoSelecionada',
                [
                    'anotacaoAtualizada' => $anotacaoAtualizada, 'usuario' => $usuario, 'idCorrespondente' => $idCorrespondente
                ]
            );

        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $mensagemSucesso = 0;
        $anotacaoSelecionado = \App\Models\Anotacao::where('AnotacaoID', $request['idSelecionado'])->first();

        if (isset($request['ConcluirAnotacao'])) {

            if ($anotacaoSelecionado['Concluido'] != true) {
                $anotacaoSelecionado['Concluido'] = true;
                $anotacaoSelecionado['DataConclusao'] = date("Y-m-d H:i:s");
            }

            $anotacaoSelecionado->save();
            $mensagemSucesso = 2;
            return redirect()->back()->with('mensagemSucesso', $mensagemSucesso);

        }  else {
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $mensagemDeletar = 0;
        if (isset($request['confirmarExclusaoAnotacao'])) {

            if (isset($request['idAnotacaoExclusao']) && $request['idAnotacaoExclusao'] != '') {

                $anotacaoSelecionado = \App\Models\Anotacao::where('AnotacaoID', $request['idAnotacaoExclusao'])->first();

                $anotacaoSelecionado->delete();
                $mensagemDeletar = 1;
                return redirect()->route('listaAnotacoes.index')->with('mensagemDeletar', $mensagemDeletar);
            }
        } else {
            return redirect()->back();
        }
    }
}
