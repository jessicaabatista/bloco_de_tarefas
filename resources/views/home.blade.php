@extends('layouts.master')

@section('content')

<div id="painel-relatorio-topo">
    <h2>Anotações Pendentes</h2>
    <hr width="45%">
    </hr>
</div>
<div id="MensagemTabelaNaoExistir"></div>

@if(count($anotacoesUsuario) > 0)
<small>
    <div class="table-responsive" id="tabelaAnotacoesPendentes">
        <table class="table table-sm table-hover" id="tabelaHomeAtt">
            <thead>
                <tr>
                    <th scope="col">Número</th>
                    <th>Data de Criação</th>
                    <th>Usuário</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $anotacoesUsuario as $anotacaoUsuario )
                <tr data-href="{{ route( 'anotacaoSelecionada', $anotacaoUsuario->AnotacaoID) }}" onclick="carregarLoading('anotacoesUsuario')">
                    <input type="hidden" id="anotacoesUsuario" value="{{$anotacaoUsuario->AnotacaoID}}">
                    <th scope="row">{{ $anotacaoUsuario->AnotacaoID }}</th>
                    <td>{{ $anotacaoUsuario->DataCriacao }}</td>
                    <td>{{ $anotacaoUsuario->Usuario->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</small>
@else
<h2 style="text-align: center; color: #008FDC; padding-bottom: 265px;">Não existem anotações pendentes no momento!</h2>
@endif
@endsection