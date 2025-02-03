@extends('layout')

@section('content')
<div class="container">
    <h2>Lista de Solicitantes</h2>
    <a href="{{ route('solicitantes.create') }}" class="btn btn-primary">Adicionar Novo Solicitante</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Grupo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($solicitantes as $solicitante)
                <tr>
                    <td>{{ $solicitante->id }}</td>
                    <td>{{ $solicitante->user->name }}</td>
                    <td>{{ $solicitante->user->email }}</td>
                    <td>{{ $solicitante->grupo->nome }}</td>
                    <td>
                        <a href="{{ route('solicitantes.edit', $solicitante->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('solicitantes.destroy', $solicitante->id) }}" method="POST" style="display: inline;">
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
