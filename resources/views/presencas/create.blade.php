@extends('layouts.navigation')

@section('title','Presenças')

@section('content')
<div class="container mt-4">
    <h1 class="criancas">Registrar Presença</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary"></h1>
        <a href="{{ route('presencas.index') }}" class="btn btn-success">Ver crianças na creche</a>
    </div>
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('presencas.store') }}" method="POST">
        @csrf
        
        <input type="hidden" id="horaAbertura" value="{{ $configuracaoHorario->hora_abertura ?? '07:30' }}">
        <input type="hidden" id="horaFechamento" value="{{ $configuracaoHorario->hora_fechamento ?? '18:00' }}">
        
        <div class="mb-3">
            <label for="crianca_id" class="form-label">Criança</label>
            <select name="crianca_id" class="form-control" required>
                @foreach($criancas as $crianca)
                    <option value="{{ $crianca->id }}" data-responsavel="{{ $crianca->responsavel }}">{{ $crianca->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" name="data" class="form-control" value="{{ old('data', date('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de Registo</label>
            <input type="hidden" name="tipo" value="entrada">
            <p class="form-control-plaintext">Entrada</p>
        </div>
        

        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" id="horaInput" name="hora" class="form-control" required>
            <small id="alertaHorario" class="text-danger" style="display:none;">A creche está fechada!</small>
        </div>

        <div class="mb-3">
            <label for="responsavel" class="form-label">Responsável</label>
            <input type="text" name="responsavel" class="form-control" value="{{ old('responsavel') }}" readonly>
        </div>
        
        <button type="submit" id="btnRegistrar" class="btn btn-success">Registrar</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const horaAbertura = document.getElementById('horaAbertura').value;
        const horaFechamento = document.getElementById('horaFechamento').value;
        const horaInput = document.getElementById('horaInput');
        const btnRegistrar = document.getElementById('btnRegistrar');
        const alertaHorario = document.getElementById('alertaHorario');

        function verificarHorario() {
            if (horaInput.value < horaAbertura || horaInput.value > horaFechamento) {
                alertaHorario.style.display = 'block';
                btnRegistrar.disabled = true;
            } else {
                alertaHorario.style.display = 'none';
                btnRegistrar.disabled = false;
            }
        }

        horaInput.addEventListener('input', verificarHorario);
    });

    document.addEventListener('DOMContentLoaded', function() {
        const criancaSelect = document.querySelector('select[name="crianca_id"]');
        const responsavelInput = document.querySelector('input[name="responsavel"]');
        
        const criancas = @json($criancas);
        
        criancaSelect.addEventListener('change', function() {
            const selectedCriancaId = criancaSelect.value;
            const selectedCrianca = criancas.find(crianca => crianca.id == selectedCriancaId);
            responsavelInput.value = selectedCrianca ? selectedCrianca.nomeresponsavel : '';
        });
    });
</script>
@endsection
