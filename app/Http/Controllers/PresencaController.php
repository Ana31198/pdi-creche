<?php

namespace App\Http\Controllers;

use App\Models\Presenca;
use App\Models\Crianca;
use Illuminate\Http\Request;
use App\Models\Configuracao;
use Illuminate\Support\Facades\Auth;

class PresencaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $configuracao = Configuracao::first();
        $horaLimite = optional($configuracao)->hora_fechamento ?? '18:00:00';
    
        $query = Presenca::with('crianca');
    
         if ($user->isResponsavel()) {
            $criancas = Crianca::doResponsavel($user->name)->pluck('id');
            $query->whereIn('crianca_id', $criancas);
        }
    
     
        if ($request->filled('data')) {
            $query->whereDate('data', $request->data);
        }
    
        if ($request->filled('crianca_id')) {
            $query->where('crianca_id', $request->crianca_id);
        }
    
        if ($request->filled('status')) {
            if ($request->status == 'presentes') {
                $query->whereNull('saida');
            } elseif ($request->status == 'retiradas') {
                $query->whereNotNull('saida');
            }
        }
    
        $presencas = $query->get();
    
    
        $alertas = $presencas->filter(function ($presenca) use ($horaLimite) {
            return is_null($presenca->saida) && now()->format('H:i:s') > $horaLimite;
        });
    
        $criancas = Crianca::all();
    
        return view('presencas.index', compact('presencas', 'alertas', 'configuracao', 'criancas'));
    }
    

    public function store(Request $request)
    {
        $configuracao = Configuracao::first();
        $horaAbertura = optional($configuracao)->hora_abertura ?? '07:30';
        $horaFechamento = optional($configuracao)->hora_fechamento ?? '18:00';

        if ($request->hora < $horaAbertura || $request->hora > $horaFechamento) {
            return redirect()->back()->with('error', 'A creche está fechada. Não é possível registrar a entrada.');
        }

        $request->validate([
            'crianca_id'  => 'required|exists:criancas,id',
            'data'        => 'required|date',
            'hora'        => 'required|date_format:H:i',
            'responsavel' => 'required|string|max:255',
        ]);

        Presenca::create($request->all());

        return redirect()->route('presencas.index')->with('success', 'Registro de presença efetuado com sucesso!');
    }

    public function create()
    {
        $configuracao = Configuracao::first();
        $criancas = Crianca::all();
        $horaAtual = now()->format('H:i');
        $crecheAberta = ($horaAtual >= optional($configuracao)->hora_abertura && $horaAtual <= optional($configuracao)->hora_fechamento);

        return view('presencas.create', compact('crecheAberta', 'criancas', 'configuracao'));
    }

    public function registar_saida(Request $request, $id)
    {
        $presenca = Presenca::findOrFail($id);

        $request->validate([
            'retirado_por' => 'required|string|max:255',
        ]);

        if ($presenca->responsavel !== $request->retirado_por) {
            return redirect()->back()->with('error', 'A criança só pode ser retirada pelo responsável que a entregou!');
        }

        $presenca->saida = now()->format('H:i:s');
        $presenca->retirado_por = $request->retirado_por;
        $presenca->save();

        return redirect()->route('presencas.index')->with('success', 'Criança retirada com sucesso.');
    }

    public function showHorario()
    {
        $configuracao = Configuracao::first();
  
        $presencas = Presenca::with('crianca')->get();

        return view('presencas.index', compact('configuracao', 'presencas'));
    }

    public function salvarHorario(Request $request)
    {
        $configuracao = Configuracao::first();
    
        if (!$configuracao) {
            $configuracao = new Configuracao();
        }
    
        if ($request->hora_abertura) {
            $configuracao->hora_abertura = $request->hora_abertura;
        }
    
        if ($request->hora_fechamento) {
            $configuracao->hora_fechamento = $request->hora_fechamento;
        }
    
        $configuracao->save();
    
        return redirect()->route('presencas.index');
    }
    
}
