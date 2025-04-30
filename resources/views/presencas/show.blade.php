@extends('layouts.navigation')
@section('title', 'Presencas')
@section('content')
<div class="container mt-4">
    <h1 class="criancas">Detalhes da Presença</h1>
    <div class="card">
        <div class="card-body">
            <h3>{{ $presenca->crianca->nome }}</h3>
            <p><strong>Data:</strong> {{ $presenca->data }}</p>
            <p><strong>Hora de Entrada:</strong> {{ $presenca->hora_entrada ?? 'Não registrado' }}</p>
            <p><strong>Hora de Saída:</strong> {{ $presenca->hora_saida ?? 'Não registrado' }}</p>
            <p><strong>Responsável:</strong> {{ $presenca->responsavel ?? 'Não informado' }}</p>
            <a href="{{ route('presencas.index') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</div>
@endsection
