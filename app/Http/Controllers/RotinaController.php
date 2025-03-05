<?php

namespace App\Http\Controllers;

use App\Models\Rotina;
use App\Models\Crianca;
use Illuminate\Http\Request;

class RotinaController extends Controller
{
    public function index()
    {
        $rotinas = Rotina::with('crianca')->get();
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

}



