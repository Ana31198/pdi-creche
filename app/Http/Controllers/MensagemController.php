<?php
namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
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
        if ($chat->educador_id !== Auth::id() && $chat->responsavel_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Você não tem permissão para enviar mensagens neste chat.');
        }

        // Criar uma nova mensagem no chat
        $message = new Message();
        $message->user_id = Auth::id();  // ID do usuário logado (educador ou responsável)
        $message->chat_id = $chat->id;
        $message->message = $request->message;
        $message->save();

        // Marcar mensagem como não lida para o outro usuário
        $chat->messages()->where('user_id', '!=', Auth::id())->update(['is_read' => false]);

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

    /**
     * Guardar uma nova mensagem no chat.
     */
    public function store(Request $request, Chat $chat)
    {
        // Validar o envio da mensagem
        $request->validate([
            'message' => 'required|string',
        ]);

        // Verificar se o usuário tem permissão para enviar mensagem no chat
        if ($chat->responsavel_id !== auth()->id() && $chat->educador_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Você não tem permissão para enviar mensagens neste chat.');
        }

        // Criar a mensagem no banco de dados
        $message = new Message();
        $message->chat_id = $chat->id;
        $message->user_id = auth()->id();
        $message->message = $request->message;
        $message->save();

        // Marcar mensagem como não lida para o outro usuário
        $chat->messages()->where('user_id', '!=', auth()->id())->update(['is_read' => false]);

        return redirect()->route('chats.show', $chat->id);
    }
}