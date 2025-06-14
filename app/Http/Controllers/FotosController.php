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
            $criancasIds = Crianca::whereRaw('LOWER(TRIM(nomeresponsavel)) = ?', [strtolower(trim($user->name))])->pluck('id');
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
        $user = Auth::user();

        if ($user->isResponsavel()) {
            $criancas = Crianca::whereRaw('LOWER(TRIM(nomeresponsavel)) = ?', [strtolower(trim($user->name))])->get();
        } else {
            $criancas = Crianca::all();
        }

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

        $user = Auth::user();
        $crianca = Crianca::findOrFail($request->crianca_id);

        if ($user->isResponsavel() && strtolower(trim($crianca->nomeresponsavel)) !== strtolower(trim($user->name))) {
            abort(403, 'Não tem permissão para adicionar fotos desta criança.');
        }

        $imagem = $request->file('imagem');
        $imageName = $imagem->getClientOriginalName();
        $caminho = 'img/criancas/' . $imageName;

        $imagem->move(public_path('img/criancas'), $imageName);

        Foto::create([
            'crianca_id' => $request->crianca_id,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'caminho' => $caminho,
        ]);

        return redirect()->route('fotos.index')->with('success', 'Foto adicionada com sucesso!');
    }

    public function show($id)
    {
        $foto = Foto::with('crianca')->findOrFail($id);
        $user = auth()->user();

        if ($user->isResponsavel() && strtolower($foto->crianca->nomeresponsavel) !== strtolower($user->name)) {
            abort(403, 'Não tem permissão para ver esta foto.');
        }

        return view('fotos.show', compact('foto'));
    }

    public function edit(Foto $foto)
    {
        $user = Auth::user();

        if ($user->isResponsavel() && strtolower($foto->crianca->nomeresponsavel) !== strtolower($user->name)) {
            abort(403, 'Não tem permissão para editar esta foto.');
        }

        $criancas = $user->isResponsavel()
            ? Crianca::whereRaw('LOWER(TRIM(nomeresponsavel)) = ?', [strtolower(trim($user->name))])->get()
            : Crianca::all();

        return view('fotos.edit', compact('foto', 'criancas'));
    }

    public function update(Request $request, Foto $foto)
    {
        $user = Auth::user();

        if ($user->isResponsavel() && strtolower($foto->crianca->nomeresponsavel) !== strtolower($user->name)) {
            abort(403, 'Não tem permissão para atualizar esta foto.');
        }

        $request->validate([
            'crianca_id' => 'required|exists:criancas,id',
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('imagem')) {
            if (file_exists(public_path($foto->caminho))) {
                unlink(public_path($foto->caminho));
            }

            $imagem = $request->file('imagem');
            $imageName = $imagem->getClientOriginalName();
            $caminho = 'img/criancas/' . $imageName;
            $imagem->move(public_path('img/criancas'), $imageName);
            $foto->caminho = $caminho;
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
        $user = Auth::user();

        if ($user->isResponsavel() && strtolower($foto->crianca->nomeresponsavel) !== strtolower($user->name)) {
            abort(403, 'Não tem permissão para apagar esta foto.');
        }

        if (file_exists(public_path($foto->caminho))) {
            unlink(public_path($foto->caminho));
        }

        $foto->delete();

        return redirect()->route('fotos.index')->with('success', 'Foto excluída com sucesso!');
    }
}