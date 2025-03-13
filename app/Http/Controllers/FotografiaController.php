<?php
namespace App\Http\Controllers;

use App\Models\Fotografia;
use App\Models\Crianca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotografiaController extends Controller
{
    public function index($crianca_id)
    {
        $crianca = Crianca::findOrFail($crianca_id);
        $fotografias = Fotografia::where('crianca_id', $crianca_id)->get();
        return view('fotografias.index', compact('crianca', 'fotografias'));
    }

    public function store(Request $request, $crianca_id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('foto')) {
            $caminho = $request->file('foto')->store('fotografias', 'public');

            Fotografia::create([
                'crianca_id' => $crianca_id,
                'caminho' => $caminho,
            ]);
        }

        return redirect()->route('fotografias.index', $crianca_id)->with('success', 'Fotografia adicionada!');
    }

    public function destroy(Fotografia $fotografia)
    {
        Storage::disk('public')->delete($fotografia->caminho);
        $fotografia->delete();

        return redirect()->back()->with('success', 'Fotografia eliminada!');
    }
}
