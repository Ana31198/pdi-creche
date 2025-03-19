@extends('layouts.navigation')

@section('title', 'Adicionar Foto')

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary">Adicionar Nova Foto</h1>

    <form action="{{ route('fotos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="crianca_id" class="form-label">Criança</label>
            <select name="crianca_id" class="form-control" required>
                <option value="">Selecione uma criança</option>
                @foreach($criancas as $crianca)
                    <option value="{{ $crianca->id }}">{{ $crianca->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem</label>
            <input type="file" name="imagem" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
