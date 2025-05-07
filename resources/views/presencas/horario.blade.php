@extends('layouts.navigation')
@section('title', 'Presenças')
@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary mb-4">Configuração de Horário</h1>


    @if(auth()->user()->isAdmin())
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white">
                <strong>Configuração de Horário</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('configuracoes.horario') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="hora_abertura">Hora de Abertura</label>
                            <input type="time" id="hora_abertura" name="hora_abertura" class="form-control" 
                            value="{{ old('hora_abertura', $horaAbertura) }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hora_fechamento">Hora de Fechamento</label>
                            <input type="time" id="hora_fechamento" name="hora_fechamento" class="form-control" 
                            value="{{ old('hora_fechamento', $horaFechamento) }}" required>
                 </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Horário</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
