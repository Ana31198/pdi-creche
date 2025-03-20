<?php
namespace App\Http\Controllers;

use App\Models\Rotina;
use App\Models\Crianca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RotinaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
    
        // Obtém todas as crianças que o usuário tem acesso
        if ($user->isPai()) {
            $criancas = Crianca::whereRaw('LOWER(nomeresponsavel) = LOWER(?)', [$user->name])
                               ->with('rotinas')
                               ->get();
        } else {
            $criancas = Crianca::with('rotinas')->get();
        }
    
        // Filtros opcionais
        $query = Rotina::query();
    
        if ($request->has('crianca_id') && $request->crianca_id) {
            $query->where('crianca_id', $request->crianca_id);
        }
    
        if ($request->has('data') && $request->data) {
            $query->whereDate('data', $request->data);
        }
    
        // Obtém as rotinas filtradas
        $rotinas = $query->whereIn('crianca_id', $criancas->pluck('id'))
                         ->orderBy('data', 'desc')
                         ->get();
    
        return view('rotinas.index', compact('criancas', 'rotinas'));
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
        $crianca = Crianca::with('rotinas')->findOrFail($crianca_id);
        return view('criancas.historico', compact('crianca'));
    }
}