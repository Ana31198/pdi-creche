<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CriancaController extends Controller
{
    public function index (){
        return view('welcome');
    }
 
    public function create (){
        return view('criancas.create');
    }
     
    public function contact (){
        return view('.contact');
    }
}
