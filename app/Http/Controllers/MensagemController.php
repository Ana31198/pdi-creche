<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MensagemController extends Controller
{
    public function store(Request $request, Chat $chat)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Verificar se o utilizador pertence ao chat (nova lógica)
        if (!$chat->users->contains(Auth::id())) {
            return redirect()->route('dashboard')->with('error', 'Sem permissão.');
        }

        // Criar nova mensagem
        $message = new Message();
        $message->user_id = Auth::id();
        $message->chat_id = $chat->id;
        $message->message = $request->message;
        $message->save();

        // Marcar mensagens como não lidas para os outros utilizadores
        $chat->messages()
            ->where('user_id', '!=', Auth::id())
            ->update(['is_read' => false]);

        return redirect()->route('chats.show', $chat->id)->with('success', 'Mensagem enviada com sucesso!');
    }
}