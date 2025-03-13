@extends('layouts.navigation')

@section('title', 'Detalhes da Criança')

@section('content')
<div class="container mt-4">
    <h1>Detalhes de {{ $crianca->nome }}</h1>
    <div class="card shadow-lg mb-3">
        <div class="card-body">
            <img src="{{ asset($crianca->image) }}" alt="{{ $crianca->nome }}" class="img-fluid fixed-size-image">
            <h5 class="card-title">{{ $crianca->nome }}</h5>
            <p class="card-text">
                <strong>Gênero:</strong> {{ $crianca->genero }} <br>
                <strong>Data de Nascimento:</strong> {{ date('d/m/Y', strtotime($crianca->data_nascimento)) }} <br>
                <strong>Responsável:</strong> {{ $crianca->nomeresponsavel }} <br>
                <strong>Grau do responsável:</strong> {{ $crianca->graudeparentescodoresponsavel }} <br>
                <strong>Contato:</strong> {{ $crianca->contactodoresponsavel }} <br>
   
            </p>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
    </div>
</div>
@endsection