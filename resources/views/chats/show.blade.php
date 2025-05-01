@extends('layouts.navigation')

@section('title', 'Chat')

@section('content')
    <div class="container mt-4">
        <h1>
            Chat com: 
            {{ $chat->users->where('id', '!=', auth()->id())->pluck('name')->join(', ') }}
        </h1>

        <hr>

        <div class="messages mb-4">
            @foreach($chat->messages as $message)
                <div class="mb-2 p-2 border rounded @if($message->user_id === auth()->id()) bg-light @endif">
                    <strong>{{ $message->user->name }}:</strong> {{ $message->message }}<br>
                    <small class="text-muted">{{ $message->created_at->format('d/m/Y H:i') }}</small>
                </div>
            @endforeach
        </div>

        <form action="{{ route('chats.messages.store', $chat->id) }}" method="POST">
            @csrf
            <div class="form-group mb-2">
                <textarea name="message" class="form-control" rows="3" placeholder="Escreve a tua mensagem..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
@endsection