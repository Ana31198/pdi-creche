<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Crianca;
use App\Models\Rotina;
use App\Models\Presenca;
use App\Models\Fotos;
use App\Models\Contact;
use App\Models\Utilizador;
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
    
        if ($chat->educador_id !== Auth::id() && $chat->responsavel_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Você não tem permissão...');
        }
    
        $chat->load('messages.user'); // carrega mensagens com quem as escreveu
    
        return view('chats.show', compact('chat'));
    }
}