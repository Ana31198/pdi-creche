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
        $user = auth()->user();
        $rotinas = Rotina::query();
        $criancas = collect(); // Inicializamos a coleção vazia
    
        if ($user->isResponsavel()) {
            // Obtem as crianças do responsável
            $criancas = Crianca::doResponsavel($user->name)->get();
    
            // Filtra apenas as rotinas dessas crianças
            $rotinas->whereIn('crianca_id', $criancas->pluck('id'));
        } else {
            // Admins e educadores veem todas
            $criancas = Crianca::all();
    
            // Permitir filtro por criança
            if ($request->filled('crianca_id')) {
                $rotinas->where('crianca_id', $request->crianca_id);
            }
        }
    
        // Filtro por data
        if ($request->filled('data')) {
            $rotinas->whereDate('data', $request->data);
        }
    
        $rotinas = $rotinas->with('crianca')->get();
    
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