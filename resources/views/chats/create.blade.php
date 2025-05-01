@extends('layouts.navigation')

@section('title', 'Novo Chat')

@section('content')
<div class="container mt-4">
    <h1>Iniciar novo chat</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('chats.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="responsavel_id">Responsável</label>
            <select name="responsavel_id" id="responsavel_id" class="form-control" required>
                <option value="">-- Escolher Responsável --</option>
                @foreach($responsaveis as $responsavel)
                    <option value="{{ $responsavel->id }}">{{ $responsavel->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="educador_id">Educador (opcional)</label>
            <select name="educador_id" id="educador_id" class="form-control">
                <option value="">-- Escolher Educador (opcional) --</option>
                @foreach($educadores as $educador)
                    <option value="{{ $educador->id }}">{{ $educador->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Criar Chat</button>
    </form>
</div>
@endsection