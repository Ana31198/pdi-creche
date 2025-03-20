@extends('layouts.navigation')

@section('content')
<div class="container mt-4">
    <!-- Título e Botão de Adição -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="criancas">Publicações de Rotinas</h1>

        @if(auth()->user()->isEducador())
            <a href="{{ route('rotinas.create') }}" class="btn btn-primary">Registrar Presença</a>
        @endif
        @if(auth()->user()->isAdmin())
            <a href="{{ route('rotinas.create') }}" class="btn btn-primary">Registrar Rotina</a>
        @endif
    </div>

    <!-- Filtros de Pesquisa -->
    <form method="GET" action="{{ route('rotinas.index') }}" class="mb-4 d-flex gap-2">
        <select name="crianca_id" class="form-select">
            <option value="">Todas as Crianças</option>
            @foreach($criancas as $crianca)
                <option value="{{ $crianca->id }}" {{ request('crianca_id') == $crianca->id ? 'selected' : '' }}>
                    {{ $crianca->nome }}
                </option>
            @endforeach
        </select>
        <input type="date" name="data" value="{{ request('data') }}" class="form-control">
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <!-- Mensagem de Sucesso -->
    @if(session('success'))
        <div class="alert alert-success fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Resumo do Dia -->
    @if($rotinas->isNotEmpty())
        <div class="alert alert-info">
            <strong>{{ $rotinas->count() }}</strong> rotinas registradas hoje para 
            <strong>{{ $rotinas->pluck('crianca_id')->unique()->count() }}</strong> crianças.
        </div>
    @endif

    <!-- Feed de Publicações Organizado por Criança -->
    @foreach($criancas as $crianca)
        <div class="mb-4">
            <h3 class="border-bottom pb-2">{{ $crianca->nome }}</h3>
            <ul class="list-group">
                @foreach($crianca->rotinas as $rotina)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ date('d/m/Y', strtotime($rotina->data)) }} - {{ $rotina->atividade }}</span>
                        <div>
                            <a href="{{ route('rotinas.show', $rotina->id) }}" class="text-muted me-2">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="" class="text-muted me-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0" 
                                    onclick="return confirm('Tem certeza que deseja eliminar esta publicação?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
@endsection
