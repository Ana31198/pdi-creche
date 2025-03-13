@extends('layouts.navigation')

@section('title','Registrar Presença')

@section('content')
<div class="container mt-4">
    <h1 class="criancas">Registrar Presença</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary"></h1>
        <a href="{{ route('presencas.index') }}" class="btn btn-success">Ver crianças na creche</a>
    </div>
    
    <form action="{{ route('presencas.store') }}" method="POST">
        @csrf
        
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
            <label for="tipo" class="form-label">Tipo de Registo</label>
            <select name="tipo" class="form-control" required>
                <option value="entrada">Entrada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" name="hora" class="form-control" value="{{ old('hora') }}" required>
        </div>

        <div class="mb-3">
            <label for="responsavel" class="form-label">Responsável</label>
            <input type="text" name="responsavel" class="form-control" value="{{ old('responsavel') }}" readonly>
        </div>
        
        <button type="submit" class="btn btn-success">Registrar</button>
    </form>
</div>

@endsection
<script>
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