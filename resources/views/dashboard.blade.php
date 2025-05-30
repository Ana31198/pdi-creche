@extends('layouts.navigation')
@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">

    {{-- Pesquisa --}}
    <div id="search-container" class="col-md-12 mb-4">
        <h1 class="crianca">Pesquise uma Criança</h1>
        <form action="{{ route('dashboard') }}" method="GET">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control form-control-lg"
                       placeholder="Pesquise uma criança" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-search"></i> Pesquisa
                </button>
            </div>
        </form>
    </div>

    {{-- Notificações --}}
    @php
        $notificacoes = auth()->user()->unreadNotifications;
    @endphp

    @if ($notificacoes->count())
        <div class="alert alert-info">
            <h5>Notificações</h5>
            <ul>
                @foreach ($notificacoes as $notification)
                    <li>
                        {{ $notification->data['message'] ?? 'Nova notificação' }}
                        @if (!empty($notification->data['url']))
                            <a href="{{ $notification->data['url'] }}" class="btn btn-sm btn-primary ms-2">Pagar Agora</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Lista de Crianças --}}
    <h1 class="criancas">Lista de Crianças</h1>

    @if($criancas->isEmpty())
        <p class="text-muted text-center">Nenhuma criança encontrada.</p>
    @else
        <div class="row">
            @foreach($criancas as $crianca)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg rounded-lg overflow-hidden transform-hover">
                        <img src="{{ asset($crianca->image) }}" alt="{{ $crianca->nome }}" class="img-fluid card-img-top" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $crianca->nome }}</h5>
                            <p class="card-text">
                                <strong>Gênero:</strong> {{ $crianca->genero }}<br>
                                <strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($crianca->data_nascimento)->format('d/m/Y') }}<br>
                                <strong>Responsável:</strong> {{ $crianca->nomeresponsavel }}<br>
                                <strong>Grau do responsável:</strong> {{ $crianca->graudeparentescodoresponsavel }}<br>
                                <strong>Contato:</strong> {{ $crianca->contactodoresponsavel }}
                            </p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('criancas.show', $crianca->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-info-circle"></i> Saber mais
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection