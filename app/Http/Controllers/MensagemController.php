<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;  // Alteração para usar 'Message' em vez de 'Mensagem'
use Illuminate\Http\Request;
use Auth;

class MensagemController extends Controller
{
    // Método para enviar mensagem
    public function sendMessage(Request $request, $chatId)
    {
        // Validação da mensagem
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Encontrar o chat específico
        $chat = Chat::findOrFail($chatId);

        // Verificar se o usuário logado é parte do chat (educador ou responsável)
      

        // Criar uma nova mensagem no chat
        $message = new Message();
        $message->user_id = Auth::id();  // ID do usuário logado (educador ou responsável)
        $message->chat_id = $chat->id;
        $message->message = $request->message;
        $message->save();

        // Redirecionar para a página do chat com uma mensagem de sucesso
        return redirect()->route('chats.show', ['chat' => $chat->id])->with('success', 'Mensagem enviada com sucesso!');
    }

    // Método para exibir o chat
    public function show($chatId)
    {
        // Carregar o chat com as mensagens e os usuários
        $chat = Chat::with('messages.user')->findOrFail($chatId);

        // Exibir a view do chat com as mensagens
        return view('chats.show', compact('chat'));
    }
    public function create(Chat $chat)
    {
        return view('mensagens.create', compact('chat'));
    }

    /**
     * Guardar uma nova mensagem no chat.
     */
    public function store(Request $request, Chat $chat)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);
        
        Message::create([
            'chat_id' => $chat->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);
    
        return redirect()->route('chats.show', $chat->id)->with('success', 'Mensagem enviada com sucesso!');
    }
}