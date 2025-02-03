@extends('layout')

@section('content')
<div class="container">
    <h2>Lista de Pedidos</h2>
    <div class="pull-right mb-3">
        <a class="btn btn-success" href="{{ route('pedidos.create') }}">Criar Novo Pedido</a>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        sds
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Status</th>
                <th>IdSolicitante</th>
                <th>IdGrupo</th>
                <th>Saldo Permitido</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->total }}</td>
                <td>{{ $pedido->status }}</td>
                <td>{{$pedido->solicitante_id}}</td>
                <td>{{$pedido->grupo_id}}</td>
                <td>{{$pedido->grupo->saldoPermitido}}</td>
                <td>
                    @if ($pedido->status == 'Novo' || $pedido->status == 'Em Revisão')
                    <form action="{{ route('pedidos.aprovar', $pedido->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="saldoPermitido" value="{{$pedido->grupo->saldoPermitido}}">
                        <input type="hidden" name="total" value="{{$pedido->total}}">
                        <button type="submit" class="btn btn-success">Aprovar</button>
                    </form>

                    <form action="{{ route('pedidos.solicitarAlteracoes', $pedido->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="solicitante_id" value="{{$pedido->solicitante_id}}">
                        <input type="hidden" name="grupo_id" value="{{$pedido->grupo_id}}">
                        <input type="hidden" name="total" value="{{$pedido->total}}">

                        <input type="text" name="comentario" placeholder="Motivo das alterações" required>
                        <button type="submit" class="btn btn-warning">Solicitar Alterações</button>
                    </form>

                    <form action="{{ route('pedidos.rejeitar', $pedido->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Rejeitar</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection