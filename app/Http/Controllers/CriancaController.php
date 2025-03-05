<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
 use App\Models\Crianca;

class CriancaController extends Controller
{
    public function index(){
        $criancas = Crianca::all(); 
        return view('welcome', ['criancas'=>$criancas]);
    }

    public function create(){
        return view('criancas.create');
    } 
    
    public function store(Request $request) {
        $crianca = new Crianca;
    
        $crianca->nome = $request->nome;
        $crianca->data_nascimento = $request->data_nascimento;
        $crianca->genero = $request->genero;
        $crianca->nomeresponsavel = $request->nomeresponsavel; 
        $crianca->graudeparentescodoresponsavel = $request->graudeparentescodoresponsavel;
        $crianca->contactodoresponavel = $request->contactodoresponavel;
    
      
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->file('image');
       
            $imageName = $requestImage->getClientOriginalName(); 
    
            $directory = 'img/criancas';
        
            $requestImage->move(public_path($directory), $imageName);

            $crianca->image = $directory . '/' . $imageName;
        }
        
        
        $crianca->save();
    
        return redirect('/');
    }
    
    
    public function rotina(){
        return view('criancas.rotina');
    }
    public function show($id)
    {
        $crianca = Crianca::findOrFail($id); // Retorna um erro 404 se não encontrar
        return view('criancas.show', compact('crianca'));
    }
}
