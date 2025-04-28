<?php
namespace App\Http\Controllers;

use App\Models\Rotina;
use App\Models\Crianca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RotinaController extends Controller
{public function index(Request $request)
    {
        $user = auth()->user();
        $criancas = collect(); // Inicializamos a coleção vazia
        $rotinas = Rotina::query();
    
        // Obter as crianças conforme o tipo de utilizador
        if ($user->isResponsavel()) {
            $criancas = Crianca::where('nomeresponsavel', $user->name)->get();
        } else {
            $criancas = Crianca::all();
        }
    
        // Filtro por criança (aplicável para todos os tipos de utilizadores, se tiverem crianças associadas)
        if ($request->filled('crianca_id')) {
            $rotinas->where('crianca_id', $request->crianca_id);
        } elseif ($user->isResponsavel()) {
            // Para responsáveis, limitar sempre às crianças associadas
            $rotinas->whereIn('crianca_id', $criancas->pluck('id'));
        }
    
        // Filtro por data
        if ($request->filled('data')) {
            $rotinas->whereDate('data', $request->data);
        }
    
        $rotinas = $rotinas->get();
    
        return view('rotinas.index', compact('rotinas', 'criancas'));
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
        $user = auth()->user();
    
        // Se o utilizador for um responsável
        if ($user->isResponsavel()) {
            $crianca = $rotina->crianca;
    
            // Verificar se a criança está associada a este responsável (com trim e lowercase para maior robustez)
            if (!$crianca || strtolower(trim($crianca->nomeresponsavel)) !== strtolower(trim($user->name))) {
                abort(403, 'Acesso negado. Esta rotina não pertence a uma criança associada a si.');
            }
        }
    
        return view('rotinas.show', compact('rotina'));
    }
    
    

    public function historico($crianca_id)
    {
        $crianca = Crianca::with('rotinas')->findOrFail($crianca_id);
        
        // Agora você tem a criança e as rotinas associadas a ela
        $rotinas = $crianca->rotinas; // Aqui você acessa as rotinas da criança
    
        return view('criancas.historico', compact('crianca', 'rotinas'));
    }
    
}