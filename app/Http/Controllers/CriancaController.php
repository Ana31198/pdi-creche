<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use App\Models\Crianca;
use Illuminate\Support\Facades\Auth;


class CriancaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        if ($user->isResponsavel()) {
            $criancas = Crianca::doResponsavel($user->name)->get();
        } else {
            $criancas = Crianca::all(); 
        }
    
        return view('criancas.index', compact('criancas'));
    }
    public function create() {
        return view('criancas.create');
    } 
    
    public function store(Request $request) {
        $crianca = new Crianca;
    
        $crianca->nome = $request->nome;
        $crianca->data_nascimento = $request->data_nascimento;
        $crianca->genero = $request->genero;
        $crianca->nomeresponsavel = $request->nomeresponsavel; 
        $crianca->graudeparentescodoresponsavel = $request->graudeparentescodoresponsavel;
        $crianca->contactodoresponsavel = $request->contactodoresponsavel; 
    
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->file('image');
            $imageName = time() . '_' . $requestImage->getClientOriginalName(); 
            $directory = 'img/criancas';
            $requestImage->move(public_path($directory), $imageName);
            $crianca->image = $directory . '/' . $imageName;
        }
        
        $crianca->save();
    
        return redirect('/criancas')->with('success', 'Criança adicionada com sucesso!');
    }
    public function show($id)
    {
        $user = Auth::user();
    
       
        if ($user->isResponsavel()) {
            $crianca = Crianca::where('id', $id)
                ->whereRaw('LOWER(nomeresponsavel) = LOWER(?)', [$user->name])
                ->first();
        } else {
            $crianca = Crianca::find($id);
        }
    
        if (!$crianca) {
            abort(403, 'Acesso não autorizado.');
        }
    
        return view('criancas.show', compact('crianca'));
    }
    public function fotografia()
{
    return $this->hasMany(Fotografia::class);
}

    
}