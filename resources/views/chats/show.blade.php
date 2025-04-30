@extends('layouts.navigation')

@section('title', 'Chat')

@section('content')
    <div class="container">
        <h1>Chat com: 
            {{ auth()->id() === $chat->educador_id ? $chat->responsavel->name : $chat->educador->name }}
        </h1>

        <div class="messages mb-4">
            @forelse ($chat->messages as $message)
                <div class="message mb-2 p-2 border rounded">
                    <p><strong>{{ $message->user->name }}:</strong> {{ $message->message }}</p>
                    <small>
                        {{ $message->created_at ? $message->created_at->format('d/m/Y H:i') : 'Data indisponível' }}
                    </small>
                </div>
            @empty
                <p>Sem mensagens neste chat.</p>
            @endforelse
        </div>

        <form action="{{ route('chats.messages.store', $chat->id) }}" method="POST">
            @csrf
            <div class="form-group mb-2">
                <textarea name="message" class="form-control" placeholder="Escreva a sua mensagem..." rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
        </form>
    </div>
@endsection