@extends('layouts.navigation')

@section('title', 'Chats')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Conversas</h1>

    @if($chats->isEmpty())
        <div class="alert alert-info">Ainda não tens chats iniciados.</div>
    @else
        <div class="row">
            @foreach($chats as $chat)
            <li>
                <a href="{{ route('chats.show', $chat->id) }}">
                    Chat com 
                    @if ($chat->educador_id)
                        {{ $chat->educador ? $chat->educador->name : 'Educador não encontrado' }}
                    @else
                        {{ $chat->responsavel ? $chat->responsavel->name : 'Responsável não encontrado' }}
                    @endif
                </a>
            </li>
        @endforeach
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('chats.create') }}" class="btn btn-success">
            Iniciar Novo Chat
        </a>
    </div>
</div>
@endsection