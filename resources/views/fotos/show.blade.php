@extends('layouts.navigation')

@section('title', 'Detalhes da Foto')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">{{ $foto->titulo ?? 'Sem título' }}</h2>

        @if($foto->crianca)
            <p class="text-muted">👶 {{ $foto->crianca->nome }}</p>
        @else
            <p class="text-danger">❗ Criança não associada</p>
        @endif
    </div>

    <div class="text-center">
        @if(file_exists(public_path($foto->caminho)))
            <img src="{{ asset($foto->caminho) }}" alt="{{ $foto->titulo }}" class="img-fluid rounded" style="max-height: 400px; object-fit: contain;">
        @else
            <p class="text-danger">❗ Imagem não encontrada em <code>{{ $foto->caminho }}</code></p>
        @endif
    </div>

    <div class="mt-4 text-center">
        <p>{{ $foto->descricao ?? 'Sem descrição disponível.' }}</p>
    </div>

    <div class="text-center mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">← Voltar</a>
    </div>
</div>
@endsection