@extends('layouts.master')

@section('content')

<div id="painel-relatorio-topo">
    <h2><i class="fa fa-pencil-square" aria-hidden="true"></i> Cadastro de Anotação</h2>
    <hr width="45%">
    </hr>
</div>
</br>
<div id="formularioAnotacao">
    <form method="POST" name="form">
        @csrf
        <div class="form-row" id="painel-relatorio-primeirobloco">
            <div class="form-group col-sm-4">
                <label for="usuario">Usuário</label>
                <select class="form-control form-control-sm" id="usuario" name="usuario" id="usuario" required="required">
                    <option selected hidden value=""> Usuário </option>
                    @foreach ( $usuarios as $usuario )
                    <option value="{{ $usuario->id }}"> {{ $usuario->name }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row" id="painel-relatorio-quartobloco">
            <div class="form-group col-sm-12">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" type="text" name="descricao" placeholder="Descrição" class="form-control form-control-sm" required="required" rows="3"></textarea>
            </div>
        </div>
        <br>

        <div class="botoes">
            <button class="btn btn-outline-success" type="submit" name="enviar" id="enviarAnotacao" onclick="MudarBotaoComInputs('enviarAnotacao', 'formularioAnotacao')"><i class="fa fa-check" aria-hidden="true"></i> Cadastrar</button>
        </div>
    </form>
</div>

@endsection