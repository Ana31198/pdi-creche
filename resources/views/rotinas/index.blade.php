@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Lista de Rotinas</h1>
        <a href="{{ route('rotinas.create') }}" class="btn btn-success">Adicionar Nova Rotina</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            @if($rotinas->isEmpty())
                <p class="text-muted text-center">Ainda não há rotinas registadas.</p>
            @else
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Criança</th>
                            <th>Atividade</th>
                            <th>Data</th>
                     
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rotinas as $rotina)
                            <tr>
                                <td>{{ $rotina->crianca->nome }}</td>
                                <td>{{ $rotina->atividade }}</td>
                                <td>{{ date('d/m/Y', strtotime($rotina->data)) }}</td>
                         
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
