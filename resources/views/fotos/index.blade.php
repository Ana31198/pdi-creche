@extends('layouts.navigation')

@section('title', 'Galeria de Fotografias')

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary">Galeria de Fotografias</h1>
    <p class="text-center">Momentos especiais registrados na nossa creche</p>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('fotos.create') }}" class="btn btn-success">Adicionar Foto</a>
    </div>

    <div class="row">
        @foreach($fotos as $foto)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $foto->caminho) }}" class="card-img-top" alt="Foto da creche">
                    <div class="card-body">
                        <h5 class="card-title">{{ $foto->titulo }}</h5>
                        <p class="card-text">Criança: {{ $foto->crianca->nome }}</p>
                        <p class="card-text">{{ $foto->descricao }}</p>
                        <a href="{{ route('fotos.show', $foto->id) }}" class="btn btn-primary">Ver</a>
                        <a href="{{ route('fotos.edit', $foto->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('fotos.destroy', $foto->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
