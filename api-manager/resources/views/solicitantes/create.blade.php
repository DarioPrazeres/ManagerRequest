@extends('layout')

@section('content')
<div class="container">
    <h2>Adicionar Novo Solicitante</h2>
    <form action="{{ route('solicitantes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome do Solicitante</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="email">Email do Solicitante</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="grupo_id">Grupo</label>
            <select name="grupo_id" class="form-control" required>
                @foreach ($grupos as $grupo)
                    <option value="{{ $grupo->id }}">{{ $grupo->nome }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
