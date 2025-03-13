@extends('layouts.navigation')

@section('content')
<div class="container mt-4">
    <!-- Título e Botão de Adição -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="criancas">Publicações de Rotinas</h1>

        @if(auth()->user()->isEducador())
            <a href="{{ route('rotinas.create') }}" class="btn btn-primary mb-3">Registrar Presença</a>

        @endif
        @if(auth()->user()->isAdmin())
        <a href="{{ route('rotinas.create') }}" class="btn btn-primary mb-3">Registrar Rotina</a>
    @endif
        </a>
    </div>

    <!-- Mensagem de Sucesso -->
    @if(session('success'))
        <div class="alert alert-success fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Feed de Publicações -->
    <div class="row">
        @if($rotinas->isEmpty())
            <div class="col-12 text-center">
                <p class="text-muted">Ainda não há publicações de rotinas registadas.</p>
            </div>
        @else
            @foreach($rotinas as $rotina)
                <div class="col-md-6 mb-4">
                    <div class="card rounded-3 shadow-lg">
                        <div class="card-body">
                            <!-- Cabeçalho da Publicação -->
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($rotina->crianca->image) }}" alt="{{ $rotina->crianca->nome }}" class="rounded-circle" width="50" height="50">
                                <div class="ms-3">
                                    <h5 class="card-title mb-1">{{ $rotina->crianca->nome }}</h5>
                                    <small class="text-muted">{{ date('d/m/Y', strtotime($rotina->data)) }}</small>
                                </div>
                            </div>

                            <!-- Corpo da Publicação (Atividade) -->
                            <div class="mt-3">
                                <p class="card-text">{{ $rotina->atividade }}</p>
                            </div>

                            <!-- Ações da Publicação (Curtir, Comentar, etc.) -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <a href="{{ route('rotinas.show', $rotina->id) }}" class="btn btn-link text-muted">
                                        <i class="fas fa-info-circle"></i> Detalhes
                                    </a>
                                    <a href="" class="btn btn-link text-muted">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                </div>
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Tem a certeza que deseja eliminar esta publicação?')">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection