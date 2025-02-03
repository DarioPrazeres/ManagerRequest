@extends('layout')

@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Materiais</h2>
        <a href="{{ route('materials.create') }}" class="btn btn-success p-2">Novo Material</a>
    </div>

    <div class="row">
        @foreach ($materials as $material)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="data:image/jpeg;base64,{{ $material->photoMaterial }}" class="card-img-top" alt="Material Image" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $material->nome }}</h5>
                    <p class="card-text">Preço: {{ $material->preco }}</p>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('materials.show', $material->id) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-primary">Edit</a>
                    </div>

                    <form action="{{ route('materials.destroy', $material->id) }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


{!! $materials->links() !!}
@endsection
