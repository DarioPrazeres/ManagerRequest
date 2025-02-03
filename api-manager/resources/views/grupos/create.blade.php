@extends('layout')

@section('content')
<div class="container">
    <h2>Criar Novo Grupo</h2>
    <form action="{{ route('grupos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome do Grupo</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="saldoPermitido">Saldo Permitido</label>
            <input type="number" class="form-control" id="saldoPermitido" name="saldoPermitido" required>
        </div>
        <div class="form-group">
            <label for="aprovador_id">Aprovador</label>
            <select name="aprovador_id" class="form-control" required>
                @foreach ($aprovadores as $aprovador)
                    <option value="{{ $aprovador->id }}">{{ $aprovador->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
