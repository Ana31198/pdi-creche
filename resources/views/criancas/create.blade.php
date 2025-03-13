@extends('layouts.navigation')

@section('title', 'Adicionar Criança')

@section('content')
<div class="container">
    <h1 class="criancas">Adicionar Nova Criança</h1>
    
    <form action="{{ route('criancas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Gênero</label>
            <select name="genero" class="form-control">
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Outro">Outro</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="nomeresponsavel" class="form-label">Nome do Responsável</label>
            <input type="text" name="nomeresponsavel" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="graudeparentescodoresponsavel" class="form-label">Grau de Parentesco</label>
            <input type="text" name="graudeparentescodoresponsavel" class="form-control">
        </div>

        <div class="mb-3">
            <label for="contactodoresponsavel" class="form-label">Contato do Responsável</label>
            <input type="text" name="contactodoresponsavel" class="form-control">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Foto da Criança</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection