<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class usuarioController extends Controller
{
    public function index()
    {
        $responsaveis = \App\Models\Usuario::simplePaginate(8);
        return view('usuario', ['responsaveis' => $responsaveis]);
    }

    public function store(Request $request)
    {
        $mensagemSucesso = '';
        $qtdEmail = \App\Models\User::where('email', $request['email'])->get();

        if (count($qtdEmail) == 0) {
            $existeEmail = false;
        } else {
            $existeEmail = true;
        }

        if (isset($request['cadastrarUsuario'])  && $existeEmail == false) {

            $novoUsuario = new \App\Models\User;

            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'ativo' => $request->ativo,
                'password' =>  Hash::make($request->password)
            ]);

            $mensagemSucesso = 'sucesso';
            return redirect()->back()->with('mensagemSucesso', $mensagemSucesso);
        } else if (isset($request['desativar'])) {

            $usuario = \App\Models\Usuario::where('id', $request['desativar'])->first();

            $usuario['ativo'] = false;

            $usuario->save();
            $mensagemSucesso = 'desativado';
            return redirect()->route('usuario.index')->with('mensagemSucesso', $mensagemSucesso);
        } else {
            $mensagemErro = 'repetida';
            return redirect()->back()->with('mensagemErro', $mensagemErro);
        }
    }
}
