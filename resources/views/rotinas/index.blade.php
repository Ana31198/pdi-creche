@extends('layouts.navigation')

@section('content')
<div class="container mt-4">
    <!-- Título e Botão de Adição -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="criancas">Publicações de Rotinas</h1>

        @if(auth()->user()->isEducador() || auth()->user()->isAdmin())
            <a href="{{ route('rotinas.create') }}" class="btn btn-primary">Registar Rotina</a>
        @endif
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('rotinas.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="crianca_id" class="form-select">
                    <option value="">Todas as Crianças</option>
                    @foreach($criancas as $crianca)
                        <option value="{{ $crianca->id }}" {{ request('crianca_id') == $crianca->id ? 'selected' : '' }}>
                            {{ $crianca->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <input type="date" name="data" class="form-control" value="{{ request('data') }}">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Mensagem de Sucesso -->
    @if(session('success'))
        <div class="alert alert-success fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Lista de Rotinas -->
    @if($rotinas->isNotEmpty())
        @foreach($rotinas as $rotina)
            @php
                $crianca = $criancas->find($rotina->crianca_id);
            @endphp

            @if($crianca)
                <div class="mb-4">
                    <h3 class="border-bottom pb-2 text-primary">{{ $crianca->nome }}</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow-lg rounded-3 mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ asset($crianca->image) }}" alt="{{ $crianca->nome }}" class="rounded-circle me-3" width="50" height="50">
                                        <div>
                                            <h5 class="mb-1">{{ $crianca->nome }}</h5>
                                            <small class="text-muted">{{ date('d/m/Y', strtotime($rotina->data)) }}</small>
                                        </div>
                                    </div>
                                    <p class="card-text text-muted">{{ $rotina->atividade }}</p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('rotinas.show', $rotina->id) }}" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-info-circle"></i> Detalhes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <div class="alert alert-warning">Nenhuma rotina encontrada para os filtros aplicados.</div>
    @endif

</div>
@endsection
