<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crianca;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        if ($search) {
            $criancas = Crianca::where('nome', 'like', '%' . $search . '%')->get();
        } else {
            $criancas = Crianca::all();
        }
        
        return view('dashboard', ['criancas' => $criancas]);
    }
    
}
