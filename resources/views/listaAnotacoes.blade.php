@extends('layouts.master')

@section('content')

<div id="painel-relatorio-topo">
    <h2 class="card-title"><i class="fa fa-bars"></i> Anotações</h2>
    <hr width="45%">
    </hr>
</div>

@if (session('mensagemDeletar') == 1)
<div class="alert alert-danger" role="alert">Anotação removida com sucesso!</div>
@endif

@if (session('mensagemSucessoAnotacao') == 1)
<div class="alert alert-success" role="alert">Anotação Cadastrada com sucesso!</div>
@endif

@if (count($anotacoes) > 0)
<div id="listaAnotacoes">
    <small>
        <div class="table-responsive">
            <table class="table table-sm table-hover" id="tabela" style="cursor: pointer">
                <thead>
                    <tr>
                        <th scope="col">Nº</th>
                        <th>Usuário</th>
                        <th>Concluído</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $anotacoes as $anotacao )
                    <tr data-href="{{ route( 'anotacaoSelecionada', $anotacao->AnotacaoID) }}" onclick="carregarLoading('anotacaoID')">
                        <input type="hidden" id="anotacaoID" value="{{ $anotacao->AnotacaoID }}">
                        <th scope="row">{{ $anotacao->AnotacaoID }}</th>
                        <td>{{ $anotacao->usuario->name }}</td>
                        <td>{{ $anotacao->Concluido }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </small>
</div>
<br>
<div class="paginacao">
    {{ $anotacoes->links() }}
</div>
@else

<h2 style="text-align: center; color: #008FDC; padding-bottom: 265px;">Não foram encontradas anotações cadastradas no momento!</h2>
@endif
@endsection