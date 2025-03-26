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

    <!-- Filtros para Admin e Responsável -->
    <form method="GET" action="{{ route('rotinas.index') }}" class="mb-3">
        <div class="row">
            @if(auth()->user()->isAdmin())
                <!-- Filtro por Criança para Admin -->
                <div class="col-md-4">
                    <select name="crianca_id" class="form-select">
                        <option value="">Todas as Crianças</option> <!-- Opção para todas as crianças -->
                        @foreach($criancas as $crianca)
                            <option value="{{ $crianca->id }}" 
                                {{ request('crianca_id') == $crianca->id ? 'selected' : '' }}>
                                {{ $crianca->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @elseif(auth()->user()->isEducador())
                <!-- Filtro por Criança para Educador -->
                <div class="col-md-4">
                    <select name="crianca_id" class="form-select">
                        <option value="">Todas as Crianças</option>
                        @foreach($criancas as $crianca)
                            <option value="{{ $crianca->id }}" 
                                {{ request('crianca_id') == $crianca->id ? 'selected' : '' }}>
                                {{ $crianca->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @else
                <!-- Filtro para Responsável: apenas as crianças associadas a ele -->
                <div class="col-md-4">
                    <select name="crianca_id" class="form-select">
                        <option value="">Todas as Crianças</option>
                        @foreach($criancas->where('nomeresponsavel', auth()->user()->name) as $crianca)
                            <option value="{{ $crianca->id }}" 
                                {{ request('crianca_id') == $crianca->id ? 'selected' : '' }}>
                                {{ $crianca->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <!-- Filtro por Data -->
            <div class="col-md-4">
                <input type="date" name="data" class="form-control" value="{{ request('data') }}">
            </div>

            <!-- Botão de Filtrar -->
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

    <!-- Resumo do Dia -->
    @php
        // Filtragem para Admin: Se não há filtro de criança, mostra todas
        if(auth()->user()->isAdmin() && request('crianca_id') == '') {
            $criancasFiltradas = $criancas;
        } elseif(auth()->user()->isAdmin() && request('crianca_id')) {
            $criancasFiltradas = $criancas->where('id', request('crianca_id'));
        } elseif(auth()->user()->isEducador()) {
            // Educador pode ver todas as rotinas ou filtrar por criança
            $criancasFiltradas = request('crianca_id') ? $criancas->where('id', request('crianca_id')) : $criancas;
        } else {
            // Se for um responsável, mostra apenas as crianças associadas ao responsável
            $criancasFiltradas = $criancas->where('nomeresponsavel', auth()->user()->name);
        }

        // Filtrar rotinas pelas crianças selecionadas
        $rotinasFiltradas = $rotinas->whereIn('crianca_id', $criancasFiltradas->pluck('id'));

        // Filtrar por data se uma data for selecionada
        if(request('data')) {
            $rotinasFiltradas = $rotinasFiltradas->where('data', request('data'));
        }
    @endphp

    @if($rotinasFiltradas->isNotEmpty())
        <!-- Exibir resumo -->
    @else
        <div class="alert alert-warning">Nenhuma rotina encontrada para os filtros aplicados.</div>
    @endif

    <!-- Feed de Publicações -->
    @foreach($criancasFiltradas as $crianca)
        @php
            $rotinasDaCrianca = $rotinasFiltradas->where('crianca_id', $crianca->id);
        @endphp

        @if($rotinasDaCrianca->isNotEmpty())
            <div class="mb-4">
                <h3 class="border-bottom pb-2 text-primary">{{ $crianca->nome }}</h3>
                <div class="row">
                    @foreach($rotinasDaCrianca as $rotina)
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
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

</div>
@endsection
