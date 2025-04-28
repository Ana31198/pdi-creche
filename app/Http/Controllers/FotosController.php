<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Crianca;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FotosController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = Auth::user();
        
        if ($user->isResponsavel()) {
            $criancasIds = Crianca::where('nomeresponsavel', $user->name)->pluck('id');
            $fotosQuery = Foto::whereIn('crianca_id', $criancasIds);
        } else {
            $fotosQuery = Foto::query();
        }

        if ($search) {
            $fotosQuery->where('titulo', 'like', '%' . $search . '%');
        }
        
        $fotos = $fotosQuery->paginate(9);
        
        return view('fotos.index', ['fotos' => $fotos]);
    }
    
    public function create()
    {
        $criancas = Crianca::all();
        return view('fotos.create', compact('criancas'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'crianca_id' => 'required|exists:criancas,id',
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $imagem = $request->file('imagem');
        $caminho = $imagem->store('fotos', 'public');
    
        $foto = new Foto();
        $foto->crianca_id = $request->crianca_id;
        $foto->titulo = $request->titulo;
        $foto->descricao = $request->descricao;
        $foto->caminho = $caminho;
        $foto->save();
    
        return redirect()->route('fotos.index')->with('success', 'Foto adicionada com sucesso!');
    }
    
    public function show(Foto $foto)
    {
        $user = Auth::user();
        
        if ($user->isPai() && strtolower($foto->crianca->nomeresponsavel) !== strtolower($user->name)) {
            abort(403, 'Acesso não autorizado.');
        }
    
        return view('fotos.show', compact('foto'));
    }
    
    public function edit(Foto $foto)
    {
        $criancas = Crianca::all();
        return view('fotos.edit', compact('foto', 'criancas'));
    }
    
    public function update(Request $request, Foto $foto)
    {
        $request->validate([
            'crianca_id' => 'required|exists:criancas,id',
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        if ($request->hasFile('imagem')) {
            Storage::disk('public')->delete($foto->caminho);
            $foto->caminho = $request->file('imagem')->store('fotos', 'public');
        }
    
        $foto->update([
            'crianca_id' => $request->crianca_id,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
        ]);
    
        return redirect()->route('fotos.index')->with('success', 'Foto atualizada com sucesso!');
    }
    
    public function destroy(Foto $foto)
    {
        Storage::disk('public')->delete($foto->caminho);
        $foto->delete();
    
        return redirect()->route('fotos.index')->with('success', 'Foto excluída com sucesso!');
    }
}
