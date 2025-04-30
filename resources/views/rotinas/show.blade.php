@extends('layouts.navigation')

@section('title', 'Rotinas')

@section('content')
<div class="container mt-4">
    <h1>Detalhes da Rotina</h1>

    <div class="card shadow-lg mb-3">
        <div class="card-body">
            <h2>Informações da Criança</h2>
            <p>
                <strong>Nome:</strong> {{ $rotina->crianca->nome }} <br>
                <strong>Data:</strong> {{ date('d/m/Y', strtotime($rotina->data)) }} <br>
            </p>
            <h2>Atividade</h2>
            <p>
                <strong>Atividade:</strong> {{ $rotina->atividade }} <br>
                <strong>Descrição:</strong> {{ $rotina->descricao }} <br>
            </p>
        </div>
    </div>

    <a href="{{ route('rotinas.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
