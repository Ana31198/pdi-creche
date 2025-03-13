<?php

namespace App\Http\Controllers;

use App\Models\Rotina;
use App\Models\Crianca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RotinaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        if ($user->isPai()) {
            // Obtém as IDs das crianças cujo nome do responsável corresponde ao nome do user autenticado
            $criancaIds = Crianca::whereRaw('LOWER(nomeresponsavel) = LOWER(?)', [$user->name])
                                 ->pluck('id');
        } else {
            // Para educadores e admins, mostra todas as rotinas
            $criancaIds = Crianca::pluck('id');
        }
    
        // Filtra as rotinas pelas crianças obtidas
        $rotinas = Rotina::whereIn('crianca_id', $criancaIds)
                         ->with('crianca')
                         ->orderBy('data', 'desc')
                         ->get();
    
        return view('rotinas.index', compact('rotinas'));
    }
    
    
    public function create()
    {
        $criancas = Crianca::all();
        return view('rotinas.create', compact('criancas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'crianca_id' => 'required|exists:criancas,id',
            'data' => 'required|date',
            'atividade' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        Rotina::create($request->all());

        return redirect()->route('rotinas.index')->with('success', 'Rotina adicionada com sucesso!');
    }
    public function show($id)
{
    $rotina = Rotina::with('crianca')->findOrFail($id);
    return view('rotinas.show', compact('rotina'));
}

public function historico($crianca_id)
{
    $crianca = Crianca::findOrFail($crianca_id);
    $rotinas = Rotina::where('crianca_id', $crianca_id)->orderBy('data', 'desc')->get();
    return view('criancas.historico', compact('crianca', 'rotinas'));
}
}