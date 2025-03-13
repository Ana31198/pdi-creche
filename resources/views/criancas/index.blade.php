@extends('layouts.navigation')
@section('title','Creche')
@section('content')

<div class="container mt-4">
    <h1 class="criancas">Lista de Crianças</h1>
    
    <!-- Botão Adicionar Criança -->
    <div class="d-flex justify-content-end mb-4">          
        @if(auth()->user()->isEducador())
            <a href="{{ route('criancas.create') }}" class="btn btn-primary mb-3">Adiconar uma crianca </a>
        @endif
        @if(auth()->user()->isAdmin())
        <a href="{{ route('criancas.create') }}" class="btn btn-primary mb-3">Adiconar uma crianca </a>
    @endif
    </div>

    <!-- Lista de Crianças -->
    <div class="row">
        @foreach($criancas as $crianca)
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                    <img src="{{ asset($crianca->image) }}" alt="{{ $crianca->nome }}" class="img-fluid card-img-top" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $crianca->nome }}</h5>
                        <p class="card-text">
                            <strong>Gênero:</strong> {{ $crianca->genero }} <br>
                            <strong>Data de Nascimento:</strong> {{ date('d/m/Y', strtotime($crianca->data_nascimento)) }} <br>
                            <strong>Responsável:</strong> {{ $crianca->nomeresponsavel }} <br>
                            <strong>Grau do responsável:</strong> {{ $crianca->graudeparentescodoresponsavel }} <br>
                            <strong>Contato:</strong> {{ $crianca->contactodoresponsavel }}
                        </p>

                        <!-- Botões de Ação -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('criancas.show', $crianca->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-info-circle"></i> Saber mais
                            </a>
                            <a href="{{ route('criancas.historico', $crianca->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-history"></i> Ver Histórico
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection