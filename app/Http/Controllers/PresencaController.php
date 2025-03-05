<?php

namespace App\Http\Controllers;

use App\Models\Presenca;
use App\Models\Crianca;
use Illuminate\Http\Request;

class PresencaController extends Controller
{
    public function index()
    {
        $horaLimite = '13:19:00';
    
        // Busca todas as presenças do dia
        $presencas = Presenca::with('crianca')->whereDate('data', today())->get();
    
        // Filtra crianças que ainda não saíram após o horário limite
        $alertas = $presencas->filter(function ($presenca) use ($horaLimite) {
            return is_null($presenca->saida) && now()->format('H:i:s') > $horaLimite;
        });
    
        return view('presencas.index', compact('presencas', 'alertas'));
    }
    
    
    public function create()
    {
        // Busca todas as crianças para preencher o select do formulário
        $criancas = Crianca::all();
        return view('presencas.create', compact('criancas'));
    }
    
    public function store(Request $request)
{
    $request->validate([
        'crianca_id' => 'required|exists:criancas,id',
        'data'       => 'required|date',
        'hora'       => 'required|date_format:H:i',
        'tipo'       => 'required|in:entrada,saida',
        'responsavel' => 'required|string|max:255',
    ]);

    Presenca::create($request->all());

    return redirect()->route('presencas.index')
                     ->with('success', 'Registo de presença efetuado com sucesso!');
}

    
    public function show($id)
    {
        $presenca = Presenca::with('crianca')->findOrFail($id);
        return view('presencas.show', compact('presenca'));
    }
    
    public function registar_saida(Request $request, $id)
    {
        $presenca = Presenca::findOrFail($id);
    
        // Validar que o campo 'retirado_por' foi preenchido
        $request->validate([
            'retirado_por' => 'required|string|max:255',
        ]);
    
        // Verificar se o nome inserido corresponde ao responsável
        if ($presenca->responsavel !== $request->retirado_por) {
            return redirect()->back()->with('error', 'A criança só pode ser retirada pelo responsável que a entregou!');
        }
    
        // Registar a saída
        $presenca->saida = now()->format('H:i:s');
        $presenca->retirado_por = $request->retirado_por;
        $presenca->save();
    
        return redirect()->route('presencas.index')->with('success', 'Criança retirada com sucesso.');
    }
    
}
