@extends('layouts.navigation')

@section('title', 'Conversas')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Conversas</h2>
        <a href="{{ route('chats.create') }}" class="btn btn-primary">
            <i class="fas fa-comments"></i> Iniciar Novo Chat
        </a>
    </div>

    @if($chats->isEmpty())
        <div class="alert alert-info">Ainda não tens chats iniciados.</div>
    @else
        <div class="list-group shadow-sm">
            @foreach($chats as $chat)
                @php
                    $outros = $chat->users->where('id', '!=', auth()->id());
                    $nomes = $outros->pluck('name')->join(', ');
                    $ultimaMensagem = $chat->messages->last();
                @endphp
                <a href="{{ route('chats.show', $chat->id) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Chat com: {{ $nomes }}</h5>
                        @if($ultimaMensagem)
                            <small class="text-muted">{{ $ultimaMensagem->created_at->diffForHumans() }}</small>
                        @endif
                    </div>
                    @if($ultimaMensagem)
                        <p class="mb-1 text-muted">{{ Str::limit($ultimaMensagem->message, 80) }}</p>
                        <small>Última mensagem de: {{ $ultimaMensagem->user->name }}</small>
                    @else
                        <p class="mb-1 text-muted fst-italic">Sem mensagens ainda.</p>
                    @endif
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
