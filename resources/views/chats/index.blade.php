@extends('layouts.navigation')

@section('title', 'Chats')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Conversas</h1>

    @if($chats->isEmpty())
        <div class="alert alert-info">Ainda não tens chats iniciados.</div>
    @else
        <ul class="list-group">
            @foreach($chats as $chat)
                <li class="list-group-item">
                    <a href="{{ route('chats.show', $chat->id) }}">
                        Chat com: 
                        {{ $chat->users->where('id', '!=', auth()->id())->pluck('name')->join(', ') }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-4">
        <a href="{{ route('chats.create') }}" class="btn btn-success">
            Iniciar Novo Chat
        </a>
    </div>
</div>
@endsection