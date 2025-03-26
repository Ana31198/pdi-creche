@extends('layouts.navigation')

@section('title', 'Histórico de ' . $crianca->nome)

@section('content')
<div class="container mt-4">
    <h1>Histórico de Atividades de {{ $crianca->nome }}</h1>
    <div class="card shadow-lg mb-3">
        <div class="card-body">
            <h2>Informações da Criança</h2>
            <p>
                <strong>Nome:</strong> {{ $crianca->nome }} <br>
                <strong>Data de Nascimento:</strong> {{ date('d/m/Y', strtotime($crianca->data_nascimento)) }} <br>
                <strong>Responsável:</strong> {{ $crianca->nomeresponsavel }} <br>
                <strong>Contato:</strong> {{ $crianca->contactodoresponsavel }} <br>
            </p>
            <h2>Atividades</h2>
            @if($rotinas->isEmpty())
                <p class="text-muted text-center">Nenhuma atividade registrada.</p>
            @else
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Atividade</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rotinas as $rotina)
                            <tr>
                                <td>{{ $rotina->atividade }}</td>
                                <td>{{ date('d/m/Y', strtotime($rotina->data)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
