@extends('layouts.navigation')
@section('title', 'Rotinas')
@section('content')
<div class="container">
    <h1 class="criancas ">Adicionar Rotina</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary"></h1>
        <a href="{{ route('rotinas.index') }}" class="btn btn-success">Listar Rotinas</a>
    </div>
    <form action="{{ route('rotinas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="crianca_id" class="form-label">Criança</label>
            <select name="crianca_id" class="form-control">
                @foreach($criancas as $crianca)
                    <option value="{{ $crianca->id }}">{{ $crianca->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" name="data" class="form-control">
        </div>
        <div class="mb-3">
            <label for="atividade" class="form-label">Atividade</label>
            <input type="text" name="atividade" class="form-control">
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection