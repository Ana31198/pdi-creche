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
        $user = Auth::user();
    
        // Busca chats onde o utilizador participa (nova lógica)
        $chats = $user->chats()->with('users')->get();
    
        return view('chats.index', compact('chats'));
    }

    public function show(Chat $chat)
    {
        $userId = auth()->id();

        // Verificar se o utilizador pertence ao chat
        if (!$chat->users->contains($userId)) {
            return redirect()->route('dashboard')->with('error', 'Sem permissão.');
        }

        // Marcar mensagens dos outros utilizadores como lidas
        $chat->messages()
             ->where('user_id', '!=', $userId)
             ->where('is_read', false)
             ->update(['is_read' => true]);

        $chat->load('messages.user');

        return view('chats.show', compact('chat'));
    }

    public function create()
    {
        $utilizadores = User::where('id', '!=', auth()->id())->get();
        return view('chats.create', compact('utilizadores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'participants' => 'required|array|min:1',
            'participants.*' => 'exists:users,id|different:' . auth()->id(),
        ]);

        $participants = array_merge($request->participants, [auth()->id()]);
        sort($participants);

        $existing = Chat::whereHas('users', function ($q) use ($participants) {
            $q->whereIn('user_id', $participants);
        }, '=', count($participants))->first();

        if ($existing) {
            return redirect()->route('chats.show', $existing)->with('info', 'Este chat já existe.');
        }

        $chat = Chat::create();
        $chat->users()->attach($participants);

        return redirect()->route('chats.show', $chat);
    }
}