@extends('layout')

@section('content')
<div class="container">
    <h2>Criar Novo Pedido</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pedidos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="materiais">Selecione Materiais e Quantidades</label>
            <div id="materiais">
                @foreach ($materiais as $material)
                    <div class="materiais-item">
                        <label>{{ $material->nome }} - ${{ $material->preco }}</label>
                        <input type="number" name="materiais[{{ $material->id }}][quantidade]" placeholder="Quantidade" value="0" required>
                    </div>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Pedido</button>
    </form>
</div>
@endsection
