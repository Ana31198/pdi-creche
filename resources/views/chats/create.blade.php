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
            <label>Selecionar Utilizadores:</label>
            <div class="form-check">
                @foreach($utilizadores as $user)
                    <div class="mb-1">
                        <input class="form-check-input" type="checkbox" name="participants[]" value="{{ $user->id }}" id="user_{{ $user->id }}">
                        <label class="form-check-label" for="user_{{ $user->id }}">
                            {{ $user->name }} ({{ $user->role }})
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Criar Chat</button>
    </form>
</div>
@endsection