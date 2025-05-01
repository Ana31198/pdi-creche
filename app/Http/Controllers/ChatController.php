<?php
namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;

class ChatController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        // Educador vê os chats onde é educador, responsável vê os chats onde é responsável
        if ($user->isEducador()) {
            $chats = Chat::where('educador_id', $user->id)->get();
        } elseif ($user->isResponsavel()) {
            $chats = Chat::where('responsavel_id', $user->id)->get();
        } else {
            abort(403, 'Tipo de utilizador inválido.');
        }
    
        return view('chats.index', compact('chats'));
    }

    public function show(Chat $chat)
    {
        $userId = auth()->id();
    
        // Verificar se o utilizador pertence ao chat
        if ($chat->educador_id !== $userId && $chat->responsavel_id !== $userId) {
            return redirect()->route('dashboard')->with('error', 'Sem permissão.');
        }
    
        // Marcar mensagens do outro utilizador como lidas
        $chat->messages()
             ->where('user_id', '!=', $userId)
             ->where('is_read', false)
             ->update(['is_read' => true]);
    
        $chat->load('messages.user');
    
        return view('chats.show', compact('chat'));
    }

    public function create()
    {
        $educadores = User::where('role', 'educador')->get();     // Adapte ao seu sistema
        $responsaveis = User::where('role', 'responsavel')->get(); // Idem

        return view('chats.create', compact('educadores', 'responsaveis'));
    }

    public function store(Request $request)
    {
        // Validação para garantir que ambos os campos educador_id e responsavel_id sejam preenchidos
        $request->validate([
            'educador_id' => 'nullable|exists:users,id', // Educador opcional
            'responsavel_id' => 'required|exists:users,id', // Responsável obrigatório
        ]);
    
        // Se for um chat entre dois responsáveis (sem educador)
        if ($request->responsavel_id && !$request->educador_id) {
            // Verificar se já existe um chat entre os dois responsáveis
            $existingChat = Chat::where('responsavel_id', $request->responsavel_id)
                                ->whereNull('educador_id')  // Garantir que não há educador
                                ->first();
    
            if ($existingChat) {
                return redirect()->route('chats.show', $existingChat->id)
                                 ->with('error', 'Este chat já foi iniciado.');
            }
    
            // Criar o chat entre dois responsáveis
            $chat = new Chat();
            $chat->responsavel_id = $request->responsavel_id;
            $chat->educador_id = null;  // Não há educador neste chat
            $chat->save();
    
            return redirect()->route('chats.show', $chat->id)->with('success', 'Chat iniciado com sucesso!');
        }
    
        // Caso contrário, criar o chat entre educador e responsável
        $chat = new Chat();
        $chat->responsavel_id = $request->responsavel_id;
        $chat->educador_id = $request->educador_id;
        $chat->save();
    
        return redirect()->route('chats.show', $chat->id)->with('success', 'Chat iniciado com sucesso!');
    }
}