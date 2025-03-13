@extends('layouts.navigation')

@section('content')
    <h1>Detalhes da Rotina</h1>

    <p><strong>Criança:</strong> {{ $rotina->crianca->nome }}</p>
    <p><strong>Data:</strong> {{ $rotina->data }}</p>
    <p><strong>Atividade:</strong> {{ $rotina->atividade }}</p>
    <p><strong>Descrição:</strong> {{ $rotina->descricao }}</p>

    <a href="{{ route('rotinas.index') }}">Voltar</a>
@endsection