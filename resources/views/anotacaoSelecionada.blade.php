@extends('layouts.master')

@section('content')
<div id="painel-relatorio-topo">
    <h2 class="card-title"><i class="fa fa-pencil" aria-hidden="true"></i> Anotação Nº {{$anotacaoAtualizada->AnotacaoID}}</h2>
    <hr width="45%">
    </hr>
</div>
</br>
<div class="card">
    <div class="card-body">
        @if (session('mensagemSucesso') == 2)
        <div class="alert alert-success" role="alert">Conclusão realizada com sucesso!</div>
        @endif
        <input type="hidden" name="concluidoAnotacao" id="concluidoAnotacao" value="{{$anotacaoAtualizada->Concluido}}">
        <form method="post" id="formularioanotacaoSelecionada">
            @csrf
            <input type="hidden" name="idUsuarioSelecionado" id="idUsuarioSelecionado" value="{{ $usuario }}">
            <input type="hidden" name="idUsuarioAnotacaoSelecionado" id="idUsuarioAnotacaoSelecionado" value="{{ $anotacaoAtualizada->UsuarioIDFK }}">
            <input type="hidden" name="idSelecionado" id="idSelecionado" value="{{$anotacaoAtualizada->AnotacaoID}}">
            <div class="form-row" id="painel-relatorio-primeirobloco">
                <div class="form-group col-sm-4">
                    <label for="usuarioSelecionado">Usuário</label>
                    <input type="text" name="usuarioSelecionado" id="usuarioSelecionado" placeholder="{{ $anotacaoAtualizada->Usuario->name }}" class="form-control form-control-sm" disabled>
                </div>
                <div class="form-group col-sm-4">
                    <label for="dataCriacaoSelecionado">Data criação</label>
                    <input id="dataCriacaoSelecionado" type="text" name="dataCriacaoSelecionado" placeholder="{{ Carbon\Carbon::parse($anotacaoAtualizada->DataCriacao)->format('d/m/Y') }}" class="form-control form-control-sm" disabled>
                </div>
                <div class="form-group col-sm-4">
                    @if ($anotacaoAtualizada->Concluido != true)
                    <label for="dataConclusaoSelecionado">Data conclusão</label>
                    <input id="dataConclusaoSelecionado" type="text" name="dataConclusaoSelecionado" placeholder="Anotação em Aberto" class="form-control form-control-sm" disabled>
                    @else
                    <label for="dataConclusaoSelecionado">Data conclusão</label>
                    <input id="dataConclusaoSelecionado" type="text" name="dataConclusaoSelecionado" placeholder="{{ Carbon\Carbon::parse($anotacaoAtualizada->DataConclusao)->format('d/m/Y') }}" class="form-control form-control-sm" disabled>
                    @endif
                </div>
            </div>

            <div class="form-row" id="painel-relatorio-quartobloco">
                <div class="form-group col-sm-12">
                    <label for="descricaoSelecionado">Descrição</label>
                    <textarea id="descricaoSelecionado" type="text" name="descricaoSelecionado" placeholder="{{ $anotacaoAtualizada->Descricao }}" class="form-control form-control-sm" disabled rows="3"></textarea>
                </div>
            </div>
            <br>

            <div class="botoesanotacaoSelecionada" id="botoesanotacaoSelecionada">

                {{-- Concluir Anotação--}}
                @if ($idCorrespondente == true && $anotacaoAtualizada->Concluido == false)
                <button class="btn btn-outline-success" type="submit" id="ConcluirAnotacao" name="ConcluirAnotacao" onclick="MudarBotao('ConcluirAnotacao')" data-toggle="tooltip" data-placement="bottom" title="O sistema registra a data de conclusão e muda o status para concluido"><i class="fa fa-check"></i> Concluir</button>
                @endif

                {{-- Deletar Anotação--}}
                @if ($idCorrespondente == true)
                <form method="post" action="/deletarAnotacao/{{$anotacaoAtualizada->AnotacaoID}}">
                    @csrf
                    <input type="hidden" name="idAnotacaoExclusao" value="{{$anotacaoAtualizada->AnotacaoID}}">
                    <button type="submit" class="btn btn-outline-danger" id="confirmarExclusaoAnotacao" name="confirmarExclusaoAnotacao" onclick="carregarLoading('confirmarExclusaoAnotacao')">Deletar</button>
                </form>
                @endif

            </div>
        </form>
    </div>
</div>
<br>
<br>

@endsection