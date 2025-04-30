@extends('layouts.navigation')

@section('title', 'Chats')

@section('content')
    <div class="container">
        <h1>Chats</h1>

        
        @foreach ($chats as $chat)
            <div class="chat-item">
                <p>Chat com: {{ $chat->responsavel->name }}</p>
                <a href="{{ route('chats.show', $chat->id) }}">Ir para conversa</a>
            </div>
        @endforeach
    </div>
@endsection