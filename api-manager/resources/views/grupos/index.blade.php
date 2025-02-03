@extends('layout')

@section('content')
<div class="container">
    <h2>Lista de Grupos</h2>
    <a href="{{ route('grupos.create') }}" class="btn btn-primary">Adicionar Novo Grupo</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Saldo Permitido</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->id }}</td>
                    <td>{{ $grupo->nome }}</td>
                    <td>{{ $grupo->saldoPermitido }}</td>
                    <td>
                        <a href="{{ route('grupos.edit', $grupo->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
