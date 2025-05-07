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
        $criancas = collect(); 
        $rotinas = Rotina::query();
 
        if ($user->isResponsavel()) {
            $criancas = Crianca::where('nomeresponsavel', $user->name)->get();
        } else {
            $criancas = Crianca::all();
        }
    
               if ($request->filled('crianca_id')) {
            $rotinas->where('crianca_id', $request->crianca_id);
        } elseif ($user->isResponsavel()) {
           
            $rotinas->whereIn('crianca_id', $criancas->pluck('id'));
        }
    

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
    

        if ($user->isResponsavel()) {
            $crianca = $rotina->crianca;
    
       
            if (!$crianca || strtolower(trim($crianca->nomeresponsavel)) !== strtolower(trim($user->name))) {
                abort(403, 'Acesso negado. Esta rotina não pertence a uma criança associada a si.');
            }
        }
    
        return view('rotinas.show', compact('rotina'));
    }
    
    

    public function historico($crianca_id)
    {
        $crianca = Crianca::with('rotinas')->findOrFail($crianca_id);
        
       
        $rotinas = $crianca->rotinas; 
    
        return view('criancas.historico', compact('crianca', 'rotinas'));
    }
    
}