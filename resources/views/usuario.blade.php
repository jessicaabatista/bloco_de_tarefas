@extends('layouts.master')

@section('content')
<div id="painel-relatorio-topo">
    <h2>Cadastrar Usuário</h2>
    <hr width="45%">
    </hr>
</div>

@if (session('mensagemSucesso') == 'sucesso')
<div class="alert alert-success" role="alert">Cadastro realizado com sucesso!</div>
@elseif (session('mensagemSucesso') == 'desativado')
<div class="alert alert-success" role="alert">Usuário <b>desativado</b> com sucesso!</div>
@elseif (session('mensagemErro') == 'repetida')
<div class="alert alert-danger" role="alert">Cadastro não finalizado por conta de informações repetidas!</div>
@endif
<div id="formularioUsuario">
    <form method="POST" action="{{ route('usuario.store') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-sm-6">
                <label for="name">Nome</label>
                <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Insira o seu nome" required autocomplete="name" autofocus>
            </div>

            <div class="form-group col-sm-6">
                <label for="email">Endereço de E-mail</label>
                <input id="email" type="email" placeholder="Insira o seu endereço de e-mail" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group col-sm-6">
                <label for="password">Senha</label> 
                <input id="password" type="password" placeholder="Insira uma senha" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="password-confirm">Confirmar a Senha</label>
                <input id="password-confirm" type="password" placeholder="Repita a senha" class="form-control form-control-sm" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <input hidden id="ativo" type="boolean" name="ativo" required value="1">
        <br>
        <button name="cadastrarUsuario" id="cadastrarUsuario" type="submit" class="btn btn-outline-success" onclick="MudarBotaoComInputs('cadastrarUsuario', 'formularioUsuario')">
            Cadastrar
        </button>
    </form>
</div>

@endsection