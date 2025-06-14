<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crianca;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = Auth::user();

        // Base da query
        $query = Crianca::query();

        // Se for responsável, restringe à crianças do seu nome
        if ($user->role === 'responsavel') {
            $query->whereRaw('LOWER(TRIM(nomeresponsavel)) = ?', [strtolower(trim($user->name))]);
        }

        // Se houver pesquisa, aplica filtro pelo nome da criança
        if ($search) {
            $query->where('nome', 'like', '%' . $search . '%');
        }

        $criancas = $query->get();

        return view('dashboard', ['criancas' => $criancas]);
    }
}